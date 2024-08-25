<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Create a new user in the database.
     *
     * @param array $data The data needed to create a new user (e.g., 'name', 'email', 'password', 'role').
     * @return \App\Models\User The newly created user instance.
     */
    public function createUser($data)
    {
        // Create and save a new user in the database using the provided data
        return User::create($data);
    }

    /**
     * Update an existing user's information in the database.
     *
     * @param \App\Models\User $user The user model instance to be updated.
     * @param array $data The data to update the user's information (e.g., updated 'name', 'email', 'password').
     * @return \App\Models\User The updated user instance.
     */
    public function updateUser(User $user, $data)
    {
        // Update the user's information in the database using the provided data
        $user->update($data);
        return $user;
    }

    /**
     * Delete an existing user from the database.
     *
     * @param \App\Models\User $user The user model instance to be deleted.
     * @return void
     */
    public function deleteUser(User $user)
    {
        // Delete the user from the database
        $user->delete();
    }

    /**
     * Retrieve a list of all users from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\User[] A collection of all users.
     */
    public function listUsers()
    {
        // Retrieve and return all users from the database
        return User::all();
    }
}

