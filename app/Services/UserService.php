<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
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
