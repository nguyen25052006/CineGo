<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Trang chủ
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.authenticate');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Booking - Trúc Vân
|--------------------------------------------------------------------------
| User phải đăng nhập mới được đặt vé, xem lịch sử và chi tiết đặt vé.
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
    |--------------------------------------------------------------------------
    | Route alias
    |--------------------------------------------------------------------------
    | Giữ tương thích với giao diện cũ đang sử dụng bookings.*
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


/*
|--------------------------------------------------------------------------
| Admin - Movie
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/movies', [MovieController::class, 'index'])
            ->name('movies.index');

        Route::get('/movies/create', [MovieController::class, 'create'])
            ->name('movies.create');

        Route::post('/movies', [MovieController::class, 'store'])
            ->name('movies.store');
    });