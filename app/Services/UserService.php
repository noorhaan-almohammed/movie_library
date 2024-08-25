<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser($data)
    {
        return User::create($data);
    }

    public function updateUser(User $user, $data)
    {
        $user->update($data);
        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function listUsers()
    {
        return User::all();
    }
}
