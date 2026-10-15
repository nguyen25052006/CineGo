<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'duration_minutes',
        'release_date',
        'genre',
        'poster',
        'status'
    ];
    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
