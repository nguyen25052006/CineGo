<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Showtime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingController extends Controller
{
    /** Hiển thị trang đặt vé cho một suất chiếu. */
    public function create(Showtime $showtime): View
    {
        $showtime->load('movie');

        abort_if($showtime->status !== Showtime::STATUS_ACTIVE, 404, 'Suất chiếu không còn hoạt động.');

        return view('bookings.create', compact('showtime'));
    }

    /**
     * Lưu đơn đặt vé.
     *
     * Luồng nghiệp vụ:
     * 1. Validate showtime_id và quantity.
     * 2. Khóa dòng showtime để tránh hai người cùng đặt vượt số vé còn lại.
     * 3. Kiểm tra available_tickets.
     * 4. Tính unit_price, subtotal, total_amount.
     * 5. Tạo Booking + BookingDetail.
     * 6. Trừ available_tickets.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'showtime_id' => ['required', 'integer', 'exists:showtimes,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ], [
            'showtime_id.required' => 'Vui lòng chọn suất chiếu.',
            'showtime_id.exists' => 'Suất chiếu không tồn tại.',
            'quantity.required' => 'Vui lòng nhập số lượng vé.',
            'quantity.integer' => 'Số lượng vé phải là số nguyên.',
            'quantity.min' => 'Số lượng vé phải lớn hơn 0.',
        ]);

        $booking = DB::transaction(function () use ($validated) {
            /** @var Showtime $showtime */
            $showtime = Showtime::query()
                ->whereKey($validated['showtime_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($showtime->status !== Showtime::STATUS_ACTIVE) {
                throw ValidationException::withMessages([
                    'showtime_id' => 'Suất chiếu này hiện không còn hoạt động.',
                ]);
            }

            $quantity = (int) $validated['quantity'];
            $availableTickets = (int) $showtime->available_tickets;

            if ($quantity > $availableTickets) {
                throw ValidationException::withMessages([
                    'quantity' => "Chỉ còn {$availableTickets} vé cho suất chiếu này.",
                ]);
            }

            $unitPrice = (float) $showtime->ticket_price;
            $subtotal = round($quantity * $unitPrice, 2);

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'booking_code' => $this->generateBookingCode(),
                'total_amount' => $subtotal,
                'status' => Booking::STATUS_CONFIRMED,
                'booked_at' => now(),
            ]);

            $booking->bookingDetails()->create([
                'showtime_id' => $showtime->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $showtime->decrement('available_tickets', $quantity);

            return $booking;
        });

        return redirect()
            ->route('booking.show', $booking)
            ->with('success', 'Đặt vé thành công. Mã đặt vé: ' . $booking->booking_code);
    }

    /** Hiển thị lịch sử đặt vé của User đang đăng nhập. */
    public function history(): View
    {
        $bookings = Booking::query()
            ->with(['bookingDetails.showtime.movie'])
            ->where('user_id', auth()->id())
            ->latest('booked_at')
            ->paginate(8);

        return view('bookings.history', compact('bookings'));
    }

    /** Hiển thị chi tiết một Booking của chính User đang đăng nhập. */
    public function show(Booking $booking): View
    {
        abort_unless((int) $booking->user_id === (int) auth()->id(), 403);

        $booking->load(['bookingDetails.showtime.movie']);

        return view('bookings.show', compact('booking'));
    }

    /** Sinh booking_code duy nhất, ví dụ: CG-20261002-A1B2C3. */
    private function generateBookingCode(): string
    {
        do {
            $code = 'CG-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }
}
