<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserInterface
{
    public function createUser($request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);

        $user->save();

        return $user;
    }

    public function getUsers()
    {
        return User::all();
    }

    public function showUser(int $userId)
    {
        return User::findOrFail($userId);
    }

    public function updateUser(int $userId, $request)
    {
        $user = User::findOrFail($userId);

        // Mandatory update attribute
        $user->name = $request->name;

        // Optional update attribute
        if ($request->email) $user->email = $request->email;
        if ($request->password) $user->password =  Hash::make($request->password);

        $user->save();

        return $user;
    }

    public function deleteUser(int $userId)
    {
        $user = User::findOrFail($userId);

        $user->delete();

        return $user;
    }
}
