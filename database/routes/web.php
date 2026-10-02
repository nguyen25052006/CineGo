<?php

use Illuminate\Support\Facades\Route;

//Trang chủ
Route::get('/', function () {
    return view('home');
})->name('home'); //->name để đặt tên cho Route, sau này gọi trên Blade dễ hơn, fix cũng tiện

//Danh sách phim
Route::get('/movies', function () {
    return view('movies.index');
})->name('movies.index');

//Chi tiết phim
Route::get('/movies/{id}', function ($id) {
    return view('movies.show', ['id' => $id]);
})->name('movies.show');

//Trang đặt vé
Route::get('/bookings/create/{showtime_id?}', function ($showtime_id = 1) {
    return view('bookings.create', ['showtime_id' => $showtime_id]);
})->name('bookings.create');

//Lịch sử vé đã đặt
Route::get('/bookings/history', function () {
    return view('bookings.history');
})->name('bookings.history');

//Chi tiết vé
Route::get('/bookings/{id}', function ($id) {
    return view('bookings.show', ['id' => $id]);
})->name('bookings.show');
use App\Http\Controllers\Admin\MovieController as AdminMovieController;

// Phân hệ Admin quản lý phim (Đầy đủ 7 route RESTful chuẩn nhóm)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('movies', AdminMovieController::class);
});

