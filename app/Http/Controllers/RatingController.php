<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;

class RatingController extends Controller
{

    protected $ratingService;
    /**
     * constructor to inject rating service class
     * @param \App\Services\RatingService $ratingService
     */
    public function __construct(RatingService $ratingService){
        $this->ratingService = $ratingService;
    }
    /**
     * show all rating
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $ratings = $this->ratingService->getAllRatings();
        $formattedRatings = $ratings->map(function ($rating) {
            return [
                'rating_id' => $rating->id,
                'user_name' => $rating->user->name,
                'movie_title' => $rating->movie->title,
                'rating' => $rating->rating,
                'review' => $rating->review,
            ];
        });
        return response()->json($formattedRatings, 200);
    }
    /**
     * store new rating in database
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
        $rating = $this->ratingService->createRating($validatedData);
        return response()->json($rating, 201);
    }

    /**
     * show a specific rating
     * @param \App\Models\Rating $rating
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(Rating $rating)
    {
        $formattedRatings = [
                'user_name' => $rating->user->name,
                'movie_title' => $rating->movie->title,
                'rating' => $rating->rating,
                'review' => $rating->review,
            ];
        return response()->json($formattedRatings, 200);
    }

    /**
     * update a specific rating
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rating $rating
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Rating $rating)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);
        $updatedRating = $this->ratingService->updateRating($rating,$validatedData);
        return response()->json($updatedRating, 200);
    }

    /**
     * delete a spicefic rating
     * @param \App\Models\Rating $rating
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Rating $rating)
    {
        $this->ratingService->deleteRating($rating);
        return response()->json(null, 204);
    }
}
