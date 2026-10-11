<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'showtime_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /** BookingDetail thuộc về một Booking. */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /** BookingDetail thuộc về một Showtime. */
    public function showtime(): BelongsTo
    {
        return $this->belongsTo(Showtime::class);
    }
}
