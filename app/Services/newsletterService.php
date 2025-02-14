<?php

namespace App\Services;

use App\Models\EmailLog;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsletterService
{
    public function subscribe($email)
    {
        $newsletter = Newsletter::firstOrCreate(
            ['email' => $email],
            ['otp_code' => Str::random(6)]
        );

        if ($newsletter->is_verified) {
            return ['status' => 'error', 'message' => 'Email ini sudah terverifikasi sebelumnya.'];
        }

        // -- Start Rate Limiter -- 
        $today = Carbon::today();
        $key = 'newsletter-email-verification:' . $email;

        if (RateLimiter::tooManyAttempts($key, 1)) {
            return ['status' => 'error', 'message' => 'Terlalu banyak permintaan Verifikasi Email, coba lagi dalam 5 menit.'];
        }

        $totalEmailsToday = EmailLog::whereDate('sent_at', $today)
            ->where('type', 'newsletter_email_verification')
            ->count();

        if ($totalEmailsToday >= 490) {
            return ['status' => 'error', 'message' => 'Batas pengiriman Verifikasi Email hari ini telah tercapai. Coba lagi besok.'];
        }

        $userEmailCount = EmailLog::where('email', $email)
            ->where('type', 'newsletter_email_verification')
            ->whereDate('sent_at', $today)
            ->count();

        if ($userEmailCount >= 2) {
            return ['status' => 'error', 'message' => 'Anda hanya bisa mengirim permintaan Verifikasi Email 2 kali per hari.'];
        }

        EmailLog::create([
            'email' => $email,
            'type' => 'newsletter_email_verification',
            'sent_at' => now(),
        ]);

        RateLimiter::hit($key, 300); // Berlaku 5 menit

        $newsletter->update(['otp_code' => Str::random(6)]);

        Mail::send('emails.newsletterVerification', [
            'otp' => $newsletter->otp_code,
            'email' => $email
        ], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Verifikasi Email');
        });

        return ['status' => 'success', 'message' => 'Kode OTP telah dikirim ke email Anda. Silakan verifikasi email Anda.'];
    }

    public function verify($email, $otp_code)
    {
        $newsletter = Newsletter::where('email', $email)->first();

        if (!$newsletter) {
            return ['status' => 'error', 'message' => 'Email tidak ditemukan.'];
        }

        if ($newsletter->is_verified) {
            return ['status' => 'error', 'message' => 'Email ini sudah diverifikasi sebelumnya.'];
        }

        if ($newsletter->otp_code !== $otp_code) {
            return ['status' => 'error', 'message' => 'Kode OTP tidak Valid.'];
        }

        $newsletter->update([
            'is_verified' => true,
            'verified_at' => Carbon::now(),
            'otp_code' => null, // Hapus OTP setelah verifikasi
        ]);

        return ['status' => 'success', 'message' => 'Terimakasih telah berlangganan layanan kami. Email anda berhasil kami Verifikasi.'];
    }

    public function getSubscribers()
    {
        return Newsletter::orderByRaw('is_verified DESC, created_at DESC')->paginate(50);
    }

    public function countSubscribers()
    {
        return [
            'total' => Newsletter::count(),
            'verified' => Newsletter::where('is_verified', true)->count()
        ];
    }

    public function deleteSubscriber(Newsletter $newsletter)
    {
        $newsletter->delete();
    }
}
