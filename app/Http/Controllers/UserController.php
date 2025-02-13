<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Users', 'url' => url('/dashboard/users'), 'active' => true]
        ];

        $users = $this->userService->getAdminUsers();
        return response()->view('dashboard.users.index', [
            "title" => "Users",
            'breadcrumbs' => $breadcrumbs,
            "users" => $users,
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js"
            ]
        ]);
    }

    public function login()
    {
        return response()->view('home.login.login', [
            "title" => "Login",
            "css" => ["/assets/css/home/login.css"],
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($this->userService->authenticateUser($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with("success", "success login!");
        }

        return back()->with("error", "Email or Password is Wrong!");
    }

    public function register()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Users', 'url' => url('/dashboard/users'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true]
        ];

        return view("dashboard.users.registration", [
            "title" => "Users",
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:255"
        ]);

        $this->userService->registerUser($validatedData);
        return redirect("/dashboard/users")->with("success", "Registration Successful!");
    }

    public function destroy(Request $request, User $user)
    {
        $canDelete = $this->userService->canDeleteUser($user);

        if (!$canDelete) {
            return redirect('/dashboard/users')
                ->with('error', 'Cannot delete this user because it is associated with one or more publications, or it is associated with one or more members approval.');
        }

        $this->userService->deleteUser($user);
        return redirect("/dashboard/users")->with("success", "User has been deleted!");
    }

    public function changePassword($email)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Change Password', 'url' => url('/dashboard/users'), 'active' => true],
            ['label' => $email, '', 'active' => true]
        ];

        return view("dashboard.users.changePassword", [
            "title" => "Change Password",
            'breadcrumbs' => $breadcrumbs,
            "javascript" => ['/assets/js/dashboard/change-password.js']
        ]);
    }

    public function doChangePassword(Request $request, $email)
    {
        // Validasi input
        $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|min:8',
            'confirm-new-password' => 'required|same:new-password'
        ]);

        // Verifikasi apakah pengguna yang dimaksud adalah pengguna yang sedang login
        if (Auth::user()->email !== $email) {
            abort(403, 'Unauthorized action.');
        }

        // Update password
        $user = Auth::user();
        if (!$this->userService->changeUserPassword($user, $request->input('old-password'), $request->input('new-password'))) {
            return back()->with('error', 'Old password is incorrect.');
        }

        // Redirect dengan pesan sukses
        return back()->with('success', 'Password changed successfully.');
    }

    public function showForgetPasswordForm()
    {
        return response()->view('home.login.forgetPassword', [
            "title" => "Forget Password",
            "css" => ["/assets/css/home/login.css"],
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(
            ['email' => 'required|email|exists:users,email'],
            [
                'email.exists' => 'Email yang anda masukkan salah.',
            ]
        );

        $this->userService->sendResetLink($request->email);

        return redirect('/login')->with('status', 'Email reset password telah dikirim.');
    }

    // Tampilkan halaman reset password
    public function showResetPasswordForm($token)
    {
        return response()->view('home.login.resetPassword', [
            "title" => "Reset Password",
            "css" => ["/assets/css/home/login.css"],
            'token' => $token
        ]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
        ], [
            'password.confirmed' => "Konfirmasi password tidak sama!",
            'password.min' => "Password paling sedikit mengandung 8 karakter!"
        ]);

        $result = $this->userService->resetPassword($request->token, $request->password);

        if (isset($result['error'])) {
            return back()->withErrors(['error' => $result['error']]);
        }

        return redirect('/login')->with('status', $result['success']);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");
    }
}
