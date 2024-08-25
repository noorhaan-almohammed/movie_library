<?php
namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',      // Name of the user
        'email',     // Email of the user (used for login)
        'password',  // User's password (hashed before saving)
        'role'       // Role of the user (e.g., admin, user)
    ];

    /**
     * Mutator to automatically hash the password before saving it to the database.
     *
     * @param string $password The plaintext password input by the user.
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        // Hash the password and store it in the 'password' attribute
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * These attributes are hidden when the user model is serialized to an array or JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Hide the password to avoid exposing sensitive information
        'remember_token',   // Hide the remember_token, which is used for "remember me" functionality
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * This method casts the specified attributes to their intended data types.
     *
     * @return array<string, string> The array of attributes and their corresponding types.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Cast email_verified_at to a datetime object
            'password' => 'hashed',             // Password is stored as a hashed value
        ];
    }
}
