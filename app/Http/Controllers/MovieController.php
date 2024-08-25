<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $movieService;
    /**
     * constructor to inject movie service class
     * @param \App\Services\MovieService $movieService
     */
    public function __construct(MovieService $movieService){
        $this->movieService = $movieService;
       }
    /**
     * get movies from server with filtering by genre or director if it passed in URL parameters or sort by the passed parameter desc by default or determine the sort direction by passing sort_direction in URL parameter and finally return 5 movies per page by default or you cann detrmine it by passing per_page in URL parameter.
     * method GET
     * http://127.0.0.1:8001/api/movies?genre=?? && director=?? && sort_by=?? && sort_direction=?? && per_page=??
     * or just one filter http://127.0.0.1:8001/api/movies?genre=??
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $movies = $this->movieService->list_movies($request);
        return response()->json($movies, 200);
    }

    /**
     * Store a newly Movie in storage after validate it.
     * method POST
     * http://127.0.0.1:8001/api/movies
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);
        $movie = $this->movieService->createMovie($validatedData);

        return response()->json($movie, 201);
    }

    /**
     * Return movie data with average ratings
     * method GET
     * http://127.0.0.1:8001/api/movies/5
     * @param \App\Models\Movie $movie
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(Movie $movie)
    {
        $ratings = $movie->ratings()->with('user')->get();
        // Calculate the average ratings for this movie.
        $averageRating = $movie->ratings()->avg('rating');

        return response()->json([
            'movie_title' => $movie->title,
            'director' => $movie->director,
            'genre' => $movie->genre,
            'description' => $movie->description,
            'release_year' => $movie->release_year,
            'average_rating' => $averageRating,
            'ratings' => $ratings->map(function($rating) {
                return [
                    'user_name' => $rating->user->name,
                    'rating' => $rating->rating,
                    'review' => $rating->review,
                ];
            })
        ], 200);
    }

    /**
     * Update the specified movie in storage.
     * method PUT
     * http://127.0.0.1:8001/api/movies/{id}
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);
        $movie = $this->movieService->updateMovie($validatedData , $movie);
        return response()->json($movie,200);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Movie $movie
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Movie $movie)
    {
        $this->movieService->deleteMovie($movie);
        return response()->json(['message' => 'Movie deleted'], 200);
    }
}
