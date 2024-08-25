<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Inject the UserService dependency
    protected $userService;

    /**
     * Constructor to inject the UserService dependency.
     *
     * @param \App\Services\UserService $userService The service responsible for handling user-related business logic.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Store a newly created user in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the user data.
     * @return \Illuminate\Http\JsonResponse A JSON response with the created user and status code 201.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',           // Validate that 'name' is required, a string, and max length is 255 characters.
            'email' => 'required|email|unique:users',       // Validate that 'email' is required, a valid email, and unique in the users table.
            'password' => 'required|string|min:8',          // Validate that 'password' is required, a string, and has at least 8 characters.
            'role' => 'in:admin,guest',                     // Validate that 'role' is either 'admin' or 'guest'.
        ]);

        // Call the service to create a new user with the validated data
        $user = $this->userService->createUser($validatedData);

        // Return a JSON response with the created user and a 201 status code
        return response()->json($user, 201);
    }

    /**
     * Update the specified user's information in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the updated user data.
     * @param \App\Models\User $user The user model instance to be updated.
     * @return \Illuminate\Http\JsonResponse A JSON response with the updated user and status code 200.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'string|max:255',                     // Validate that 'name' is a string and max length is 255 characters.
            'email' => 'email|unique:users,email,' . $user->id,  // Validate that 'email' is a valid email and unique except for the current user.
            'password' => 'nullable|string|min:8',          // Validate that 'password', if provided, is a string with at least 8 characters.
        ]);

        // Call the service to update the user's information
        $user = $this->userService->updateUser($user, $validatedData);

        // Return a JSON response with the updated user and a 200 status code
        return response()->json($user, 200);
    }

    /**
     * Remove the specified user from the database.
     *
     * @param \App\Models\User $user The user model instance to be deleted.
     * @return \Illuminate\Http\JsonResponse A JSON response with a success message and status code 200.
     */
    public function destroy(User $user)
    {
        // Call the service to delete the user
        $this->userService->deleteUser($user);

        // Return a JSON response indicating the user was successfully deleted
        return response()->json(['message' => 'User deleted'], 200);
    }
}
