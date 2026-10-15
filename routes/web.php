<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ShowtimeController;

/*
|--------------------------------------------------------------------------
| Trang chủ
|--------------------------------------------------------------------------
*/

Route::get('/', [MovieController::class, 'home'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Phim công khai dành cho khách hàng
|--------------------------------------------------------------------------
*/

Route::get('/movies', [MovieController::class, 'publicIndex'])
    ->name('movies.index');

Route::get('/movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');


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
| Đặt vé - yêu cầu đăng nhập
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/booking/create/{showtime}', [
        BookingController::class,
        'create'
    ])->name('booking.create');

    Route::post('/booking', [
        BookingController::class,
        'store'
    ])->name('booking.store');

    Route::get('/booking/history', [
        BookingController::class,
        'history'
    ])->name('booking.history');

    Route::get('/booking/{booking}', [
        BookingController::class,
        'show'
    ])->name('booking.show');

});


/*
|--------------------------------------------------------------------------
| Quản lý phim dành cho Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/movies', [
            MovieController::class,
            'index'
        ])->name('movies.index');

        Route::get('/movies/create', [
            MovieController::class,
            'create'
        ])->name('movies.create');

        Route::post('/movies', [
            MovieController::class,
            'store'
        ])->name('movies.store');

    });

Route::resource('showtimes', ShowtimeController::class);