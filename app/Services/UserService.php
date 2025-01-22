<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAdminUsers()
    {
        return User::where('role', 'admin')->paginate(50);
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
