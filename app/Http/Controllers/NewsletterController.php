<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Services\NewsletterService;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{

    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    // Mendaftarkan Email
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns,filter',
        ]);

        $newsletter = Newsletter::firstOrCreate(
            ['email' => $request->email],
            ['otp_code' => Str::random(6)]
        );

        if ($newsletter->is_verified) {
            return redirect('/#newsletter')->with('status', 'Email ini sudah terverifikasi sebelumnya.');
        }

        // -- Start Rate Limiter -- 
        $email = $request->email;
        $today = Carbon::today();
        $key = 'newsletter-email-verification:' . $email;

        // Cek Rate Limiter (1x per 5 menit per email)
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect('/#newsletter')->with('error', 'Terlalu banyak permintaan Verifikasi Email, coba lagi dalam 5 menit.');
        }

        // Cek Global Limit (Maksimal 490 email per hari)
        $totalEmailsToday = EmailLog::whereDate('sent_at', $today)
            ->where('type', 'newsletter_email_verification')
            ->count();
        if ($totalEmailsToday >= 490) {
            return redirect('/#newsletter')->with('error', 'Batas pengiriman Verifikasi Email hari ini telah tercapai. Coba lagi besok.');
        }

        // Cek Limit Per User (Maksimal 2 kali per hari)
        $userEmailCount = EmailLog::where('email', $email)
            ->where('type', 'newsletter_email_verification')
            ->whereDate('sent_at', $today)
            ->count();
        if ($userEmailCount >= 2) {
            return redirect('/#newsletter')->with('error', 'Anda hanya bisa mengirim permintaan Verifikasi Email 2 kali per hari.');
        }

        // Simpan ke Riwayat Pengiriman Email
        EmailLog::create([
            'email' => $email,
            'type' => 'newsletter_email_verification',
            'sent_at' => now(),
        ]);

        // Hit Rate Limiter (Berlaku 5 menit)
        RateLimiter::hit($key, 300); // 300 detik = 5 menit

        // -- End Rate Limiter -- 

        // Jika email baru dibuat atau belum diverifikasi, kirim OTP baru
        $newsletter->update(['otp_code' => Str::random(6)]);

        Mail::send('emails.newsletterVerification', [
            'otp' => $newsletter->otp_code,
            'email' => $request->email
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verifikasi Email');
        });

        return redirect('/#newsletter')->with('status', 'Kode OTP telah dikirim ke email Anda. Silakan verifikasi email Anda.');
    }

    // Verify Form
    public function verifyForm($email)
    {
        return response()->view("home.newsletter.emailVerifyForm", [
            "title" => "Verify Email",
            "css" => ["/assets/css/home/login.css"],
            "email" => $email
        ]);
    }

    // Verifikasi Email dengan OTP
    public function verify(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:newsletters,email',
                'otp_code' => 'required|min:6|max:6',
            ],
            [
                'email.exists' => 'Email yang anda masukkan belum terdaftar, silahkan daftar pada form berlangganan newsletter!'
            ]
        );

        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter->is_verified) {
            return back()->with('error', 'Email ini sudah diverifikasi sebelumnya.');
        }

        if ($newsletter->otp_code !== $request->otp_code) {
            return back()->with('error', 'Kode OTP tidak Valid.');
        }

        $newsletter->update([
            'is_verified' => true,
            'verified_at' => Carbon::now(),
            'otp_code' => null, // Hapus OTP setelah verifikasi
        ]);

        return redirect('/#newsletter')->with('status', 'Terimakasih telah berlangganan layanan kami. Email anda berhasil kami Verifikasi.');
    }

    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Newsletter', 'url' => url("/dashboard/newsletter"), 'active' => true]
        ];

        $subscribers = Newsletter::orderByRaw('is_verified DESC, created_at DESC')
            ->paginate(50);
        return view('dashboard.newsletters.index', [
            "title" => "Newsletter Subscribers",
            'breadcrumbs' => $breadcrumbs,
            'subscribers' => $subscribers,
            "countSubscribers" => Newsletter::count(),
            "countVerifiedSubscribers" => Newsletter::where('is_verified', true)->count(),
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js"
            ]
        ]);
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect('/dashboard/newsletter')->with('success', "$newsletter->email successfully deleted.");
    }
}
