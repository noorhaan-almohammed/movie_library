<?php

namespace App\Services;

use App\Models\Rating;

class RatingService{

    public function getAllRatings(){
        return Rating::with(['user', 'movie'])->get();
    }
    public function createRating(array $validatedData)
    {
        return Rating::create($validatedData);
    }
    public function updateRating(Rating $rating, array $validatedData)
    {
        $rating->update($validatedData);
        return $rating;
    }
    public function deleteRating(Rating $rating)
    {
        $rating->delete();
    }
}
