<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', function () {
    return view('home');
})->name('home');

// Danh sách phim
Route::get('/movies', function () {
    return view('movies.index');
})->name('movies.index');

// Chi tiết phim
Route::get('/movies/{id}', function ($id) {
    return view('movies.show', ['id' => $id]);
})->name('movies.show');

/*
|--------------------------------------------------------------------------
| Booking - route chuẩn theo tài liệu nhóm
|--------------------------------------------------------------------------
| Tất cả chức năng Booking yêu cầu User đăng nhập.
*/
Route::middleware('auth')->group(function () {
    Route::get('/booking/create/{showtime}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/booking/history', [BookingController::class, 'history'])
        ->name('booking.history');

    Route::get('/booking/{booking}', [BookingController::class, 'show'])
        ->name('booking.show');

    /*
     * Alias tương thích giao diện hiện có trên GitHub đang dùng /bookings
     * và route name bookings.*. Có thể bỏ nhóm alias này sau khi UI được
     * đổi toàn bộ sang route chuẩn booking.*.
     */
    Route::get('/bookings/create/{showtime}', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('/bookings/history', [BookingController::class, 'history'])
        ->name('bookings.history');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');
});
