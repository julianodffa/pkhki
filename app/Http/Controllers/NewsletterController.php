<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    // Mendaftarkan Email
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $newsletter = Newsletter::firstOrCreate(
            ['email' => $request->email],
            ['otp_code' => Str::random(6)]
        );

        if ($newsletter->is_verified) {
            return redirect('/#newsletter')->with('status', 'Email ini sudah terverifikasi sebelumnya.');
        }

        // Jika email baru dibuat atau belum diverifikasi, kirim OTP baru
        $newsletter->update(['otp_code' => Str::random(6)]);

        Mail::send('emails.newsletterVerification', [
            'otp' => $newsletter->otp_code,
            'email' => $request->email
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verifikasi Email Newsletter - PKHKI');
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
