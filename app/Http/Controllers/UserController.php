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
            "css" => ["/assets/css/home/login.css"]
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if ($this->userService->authenticateUser($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with("success", "success login!");
        }

        return back()->with("error", "Username or Password is Wrong!");
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
            "username" => "required|min:5|max:255|unique:users",
            "email" => "required|email:dns|unique:users",
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

    public function changePassword($username)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Change Password', 'url' => url('/dashboard/users'), 'active' => true],
            ['label' => $username, '', 'active' => true]
        ];

        return view("dashboard.users.changePassword", [
            "title" => "Change Password",
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function doChangePassword(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|min:8',
            'confirm-new-password' => 'required|same:new-password'
        ]);

        // Verifikasi apakah pengguna yang dimaksud adalah pengguna yang sedang login
        if (Auth::user()->username !== $username) {
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

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");
    }
}
