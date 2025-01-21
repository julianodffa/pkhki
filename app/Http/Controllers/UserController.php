<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return response()->view('dashboard.users.index', [
            "title" => "Users",
            "users" => $users
        ]);
    }

    public function login()
    {
        return response()->view('home.login.login', [
            "title" => "Login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                "username" => "required",
                "password" => "required"
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with("error", "Username or Password is Wrong!");
    }

    public function register()
    {
        return view("dashboard.users.registration", [
            "title" => "Users"
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

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::create($validatedData);

        return redirect("/dashboard/users")->with("success", "Registration Successful!");
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return redirect("/dashboard/users")->with("success", "User has been deleted!");
    }

    public function changePassword($username)
    {
        return view("dashboard.users.changePassword", [
            "title" => "Change Password"
        ]);
    }

    public function doChangePassword(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|min:8',
            'confirm-new-password' => 'required|same:new-password',
        ]);

        // Verifikasi apakah pengguna yang dimaksud adalah pengguna yang sedang login
        if (Auth::user()->username !== $username) {
            abort(403, 'Unauthorized action.');
        }

        // Verifikasi password lama
        $user = Auth::user();
        if (!Hash::check($request->input('old-password'), $user->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        // Update password
        $user->password = Hash::make($request->input('new-password'));
        $user->save();

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
