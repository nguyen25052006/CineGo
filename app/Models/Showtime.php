<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showtime extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_INACTIVE = 'inactive';

    /** Danh sách trạng thái hợp lệ (dùng cho validation và dropdown). */
    public const STATUSES = [
        self::STATUS_ACTIVE   => 'Đang hoạt động',
        self::STATUS_INACTIVE => 'Ngừng hoạt động',
    ];

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
        'show_date'         => 'date',
        'ticket_price'      => 'decimal:2',
        'total_tickets'     => 'integer',
        'available_tickets' => 'integer',
    ];

    /* ------------------------- RELATIONSHIP ------------------------- */

    /** Showtime belongsTo Movie  (N - 1) */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Showtime hasMany BookingDetail (1 - N).
     * Cần model BookingDetail (do Trúc Vân làm) có cột showtime_id.
     */
    public function bookingDetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    /* --------------------------- SCOPE ------------------------------ */

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /* -------------------------- ACCESSOR ---------------------------- */

    /** Giờ bắt đầu dạng HH:MM (DB lưu HH:MM:SS). */
    public function getStartTimeShortAttribute(): string
    {
        return substr($this->start_time, 0, 5);
    }

    /** Giờ kết thúc dạng HH:MM. */
    public function getEndTimeShortAttribute(): string
    {
        return substr($this->end_time, 0, 5);
    }

    /** Giá vé định dạng 80.000đ */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->ticket_price, 0, ',', '.') . 'đ';
    }
}
