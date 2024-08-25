<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    // The attributes that are mass assignable.
    // only the attributes listed in $fillable can be assigned using mass assignment.
    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description'
    ];
  /**
     * Define a one-to-many relationship with the Rating model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */    public function ratings()
    {
            // A movie can have many ratings.
        return $this->hasMany(Rating::class);
    }
      /**
     * Scope a query to filter movies by a given genre.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
     * @param string $genre The genre to filter movies by.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByGenre($query,$genre){
          // Filter the query to include only movies of the specified genre.
        return $query->where('genre',$genre);
    }
        /**
     * Scope a query to filter movies by a specific director.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
     * @param string $director The director to filter movies by.
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeByDirector($query, $director){
    // Filter the query to include only movies directed by the specified director.
        return $query->where('director', $director);
    }
      /**
     * Scope a query to sort movies by a specific field and direction.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
     * @param string $field The field to sort movies by (e.g., 'title', 'release_year').
     * @param string $direction The sort direction, either 'asc' or 'desc'. Default is 'desc'.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortBy($query, $field, $direction = 'desc'){
     // Sort the query by the specified field in the specified direction (ascending or descending).
        return $query->orderBy($field, $direction);
    }
     /**
     * Scope a query to paginate the results based on the given page size.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
     * @param int $page The number of items to display per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function scopeByPage($query,$page){
        // Paginate the query results with the specified number of items per page.
        return $query->paginate($page);
    }
}
