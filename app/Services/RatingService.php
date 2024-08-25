<?php
namespace App\Services;

use App\Models\Rating;

class RatingService
{
    /**
     * Retrieve all ratings with their associated user and movie models.
     *
     * @return \Illuminate\Database\Eloquent\Collection A collection of all ratings with their related user and movie data.
     */
    public function getAllRatings()
    {
        // Fetch all ratings, eager loading the related 'user' and 'movie' models to minimize database queries
        return Rating::with(['user', 'movie'])->get();
    }

    /**
     * Create a new rating in the database.
     *
     * @param array $validatedData The validated data to create a new rating.
     * @return \App\Models\Rating The newly created rating instance.
     */
    public function createRating(array $validatedData)
    {
        // Create a new rating with the provided validated data
        return Rating::create($validatedData);
    }

    /**
     * Update an existing rating in the database.
     *
     * @param \App\Models\Rating $rating The rating instance to be updated.
     * @param array $validatedData The validated data for updating the rating.
     * @return \App\Models\Rating The updated rating instance.
     */
    public function updateRating(Rating $rating, array $validatedData)
    {
        // Update the rating with the provided validated data
        $rating->update($validatedData);
        return $rating;
    }

    /**
     * Delete an existing rating from the database.
     *
     * @param \App\Models\Rating $rating The rating instance to be deleted.
     * @return void
     */
    public function deleteRating(Rating $rating)
    {
        // Delete the specified rating from the database
        $rating->delete();
    }
}
