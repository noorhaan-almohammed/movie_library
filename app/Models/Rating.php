<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',   // ID of the user who gave the rating
        'movie_id',  // ID of the movie being rated
        'rating',    // Rating value (e.g., between 1 and 5)
        'review'     // Text review of the movie
    ];

    /**
     * Define an inverse one-to-many relationship with the Movie model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        // This rating belongs to a specific movie.
        return $this->belongsTo(Movie::class);
    }

    /**
     * Define an inverse one-to-many relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // This rating belongs to a specific user.
        return $this->belongsTo(User::class);
    }
}
