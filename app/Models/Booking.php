<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_CONFIRMED => 'Đã xác nhận',
        self::STATUS_CANCELLED => 'Đã hủy',
    ];

    protected $fillable = [
        'user_id',
        'booking_code',
        'total_amount',
        'status',
        'booked_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'booked_at' => 'datetime',
    ];

    /** Booking thuộc về một User. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Một Booking có một hoặc nhiều BookingDetail. */
    public function bookingDetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }
}
