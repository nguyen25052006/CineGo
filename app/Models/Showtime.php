<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showtime extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'movie_id',
        'show_date',
        'start_time',
        'end_time',
        'room_name',
        'ticket_price',
        'total_tickets',
        'available_tickets',
        'status',
    ];

    protected $casts = [
        'show_date' => 'date',
        'ticket_price' => 'decimal:2',
        'total_tickets' => 'integer',
        'available_tickets' => 'integer',
    ];

    // Một suất chiếu thuộc về một bộ phim.
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    // Một suất chiếu có thể xuất hiện trong nhiều chi tiết đặt vé.
    public function bookingDetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }
}

