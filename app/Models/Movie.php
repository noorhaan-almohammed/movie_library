<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description'
    ];
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function scopeByGenre($query,$genre){
        return $query->where('genre',$genre);
    }
    public function scopeByDirector($query, $director){
        return $query->where('director', $director);
    }
    public function scopeSortBy($query, $field, $direction = 'desc'){
        return $query->orderBy($field, $direction);
    }
    public function scopeByPage($query,$page){
        return $query->paginate($page);
    }
}
