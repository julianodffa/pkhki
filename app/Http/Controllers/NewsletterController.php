<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Services\NewsletterService;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns,filter',
        ]);

        $result = $this->newsletterService->subscribe($request->email);

        return redirect('/#newsletter')->with($result['status'], $result['message']);
    }

    public function verifyForm($email)
    {
        return response()->view("home.newsletter.emailVerifyForm", [
            "title" => "Verify Email",
            "css" => ["/assets/css/home/login.css"],
            "email" => $email
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:newsletters,email',
            'otp_code' => 'required|min:6|max:6',
        ], [
            'email.exists' => 'Email yang anda masukkan belum terdaftar, silahkan daftar pada form berlangganan newsletter!'
        ]);

        $result = $this->newsletterService->verify($request->email, $request->otp_code);

        return back()->with($result['status'], $result['message']);
    }

    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Newsletter', 'url' => url("/dashboard/newsletter"), 'active' => true]
        ];

        $subscribers = $this->newsletterService->getSubscribers();
        $counts = $this->newsletterService->countSubscribers();

        return view('dashboard.newsletters.index', [
            "title" => "Newsletter Subscribers",
            'breadcrumbs' => $breadcrumbs,
            'subscribers' => $subscribers,
            "countSubscribers" => $counts['total'],
            "countVerifiedSubscribers" => $counts['verified'],
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js"
            ]
        ]);
    }

    public function destroy(Newsletter $newsletter)
    {
        $this->newsletterService->deleteSubscriber($newsletter);
        return redirect('/dashboard/newsletter')->with('success', "$newsletter->email successfully deleted.");
    }
}