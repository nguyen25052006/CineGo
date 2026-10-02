<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return redirect()->route('admin.movies.index');
});

// Định tuyến phân hệ Quản lý Phim của Vy - Khớp 100% với file Controller
Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movies.index');
Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('admin.movies.create');
Route::post('/admin/movies', [MovieController::class, 'store'])->name('admin.movies.store');
