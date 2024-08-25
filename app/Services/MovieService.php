<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService {
    /**
     * create Movie
     * @param array $data
     * @return Movie
     */
    public function createMovie(array $data){
        return Movie::create($data);
    }
    /**
     * update movie by id
     * @param array $data
     * @param \App\Models\Movie $movie
     * @return Movie
     */
    public function updateMovie(array $data , Movie $movie){
        $movie->update($data);
        return $movie;
   }
   /**
    * delete Movie by id
    * @param \App\Models\Movie $movie
    * @return void
    */
   public function deleteMovie(Movie $movie){
       $movie->delete();
   }
   /**
    * list all movies
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
    */
   public function list_movies(Request $request){
        $query = Movie::query();

        if ($request->has('genre')) {
            $query->byGenre($request->input('genre'));
        }

        if ($request->has('director')) {
            $query->byDirector($request->input('director'));
        }

        $sortDirection = $request->input('sort_direction', 'desc');
        $sort_by = $request->input('sort_by' , 'created_at');

        $query->sortBy($sort_by, $sortDirection);
        $query->with('ratings');
        $query->withAvg('ratings', 'rating');

        $perPage = $request->input('per_page', 5);
        $movies = $query->paginate($perPage);
        return $movies;
   }
}
