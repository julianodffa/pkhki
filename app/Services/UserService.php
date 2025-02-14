<?php

namespace App\Services;

use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class UserService
{
    public function getAdminUsers()
    {
        return User::where('role', 'admin')->latest()->paginate(50);
    }

    public function authenticateUser($credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function registerUser($validatedData)
    {
        $validatedData["password"] = Hash::make($validatedData["password"]);
        User::create($validatedData);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function changeUserPassword($user, $oldPassword, $newPassword)
    {
        if (!Hash::check($oldPassword, $user->password)) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }

    public function sendResetLink($email)
    {
        $token = Str::random(60);

        // -- Start Rate Limiter -- 
        $today = Carbon::today();
        $key = 'forgot-password:' . $email;

        // Cek Rate Limiter (1x per 5 menit per email)
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect('/login')->with('error', 'Terlalu banyak permintaan reset password, coba lagi dalam 5 menit.');
        }

        // Cek Global Limit (Maksimal 490 email per hari)
        $totalEmailsToday = EmailLog::whereDate('sent_at', $today)
                                    ->where('type', 'password_reset')
                                    ->count();
        if ($totalEmailsToday >= 490) {
            return redirect('/login')->with('error', 'Batas pengiriman reset password hari ini telah tercapai. Coba lagi besok.');
        }

        // Cek Limit Per User (Maksimal 2 kali per hari)
        $userEmailCount = EmailLog::where('email', $email)
                                  ->where('type', 'password_reset')
                                  ->whereDate('sent_at', $today)
                                  ->count();
        if ($userEmailCount >= 2) {
            return redirect('/login')->with('error', 'Anda hanya bisa mengirim permintaan reset password 2 kali per hari.');
        }

        // Simpan ke Riwayat Pengiriman Email
        EmailLog::create([
            'email' => $email,
            'type' => 'password_reset',
            'sent_at' => now(),
        ]);

        // Hit Rate Limiter (Berlaku 5 menit)
        RateLimiter::hit($key, 300); // 300 detik = 5 menit

        // -- End Rate Limiter -- 

        // Simpan token ke database (hapus yang lama jika ada)
        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        // Kirim email ke user
        Mail::send('emails.resetPassword', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });
    }

    public function resetPassword($token, $password)
    {
        // Cari token di tabel password_resets
        $resetData = PasswordReset::where('token', $token)->first();

        // Periksa apakah token ada dan belum expired (dengan batas waktu 60 menit)
        if (!$resetData || now()->diffInMinutes($resetData->created_at) > 60) {
            return ['error' => 'Token tidak valid atau sudah kedaluwarsa.'];
        }

        // Cari user berdasarkan email dari token
        $user = User::where('email', $resetData->email)->first();
        if (!$user) {
            return ['error' => 'Email tidak ditemukan.'];
        }

        // Update password user dengan yang baru (dengan hash)
        $user->update(['password' => Hash::make($password)]);

        // Hapus token dari tabel password_resets setelah berhasil digunakan
        PasswordReset::where('email', $user->email)->delete();

        return ['success' => 'Password berhasil direset. Silakan login dengan password baru.'];
    }

    public function canDeleteUser(User $user): bool
    {
        if ($user->publications()->exists()) {
            return false;
        } elseif ($user->members()->exists()) {
            return false;
        } else {
            return true;
        }
    }
}
