@extends('layouts.app')

@section('title', 'CineGo - Trang Chủ Đặt Vé Xem Phim')

@section('content')
<div class="container">
    <!-- BANNER HERO -->
    <div class="p-5 mb-5 rounded-4 text-white shadow" style="background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=1200') center/cover;">
        <div class="col-md-8 py-3">
            <h1 class="display-4 fw-bold text-warning">Trải Nghiệm Điện Ảnh Đỉnh Cao</h1>
            <p class="lead mb-4">Khám phá hàng loạt bom tấn mới nhất tại rạp cùng CineGo. Đặt vé giữ chỗ trong nháy mắt!</p>
            <a href="{{ url('/movies') }}" class="btn btn-cinego btn-lg px-4 shadow">
                <i class="bi bi-ticket-detailed me-2"></i>Đặt vé ngay
            </a>
        </div>
    </div>

    <!-- MỤC PHIM ĐANG CHIẾU -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Phim Đang Chiếu</h3>
        <a href="{{ url('/movies') }}" class="text-warning text-decoration-none small fw-bold">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-5">
        <!-- Mockup Thẻ Phim 1 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=500" class="card-img-top" alt="Poster" style="height: 320px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-danger mb-2 align-self-start">Hành Động</span>
                    <h5 class="card-title fw-bold text-truncate">Chiến Binh Ánh Sáng</h5>
                    <p class="card-text text-secondary small mb-3"><i class="bi bi-clock me-1"></i>120 phút</p>
                    <a href="{{ url('/movies/1') }}" class="btn btn-sm btn-outline-light mt-auto">Xem Chi Tiết</a>
                </div>
            </div>
        </div>

        <!-- Mockup Thẻ Phim 2 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?q=80&w=500" class="card-img-top" alt="Poster" style="height: 320px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary mb-2 align-self-start">Khoa Học Viễn Tưởng</span>
                    <h5 class="card-title fw-bold text-truncate">Vũ Trụ Vô Tận</h5>
                    <p class="card-text text-secondary small mb-3"><i class="bi bi-clock me-1"></i>145 phút</p>
                    <a href="{{ url('/movies/2') }}" class="btn btn-sm btn-outline-light mt-auto">Xem Chi Tiết</a>
                </div>
            </div>
        </div>

        <!-- Mockup Thẻ Phim 3 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=500" class="card-img-top" alt="Poster" style="height: 320px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-warning text-dark mb-2 align-self-start">Hài Hước</span>
                    <h5 class="card-title fw-bold text-truncate">Chuyến Đi Bất Ổn</h5>
                    <p class="card-text text-secondary small mb-3"><i class="bi bi-clock me-1"></i>98 phút</p>
                    <a href="{{ url('/movies/3') }}" class="btn btn-sm btn-outline-light mt-auto">Xem Chi Tiết</a>
                </div>
            </div>
        </div>

        <!-- Mockup Thẻ Phim 4 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=500" class="card-img-top" alt="Poster" style="height: 320px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-dark border border-secondary mb-2 align-self-start">Kinh Dị</span>
                    <h5 class="card-title fw-bold text-truncate">Đêm Không Ngủ</h5>
                    <p class="card-text text-secondary small mb-3"><i class="bi bi-clock me-1"></i>105 phút</p>
                    <a href="{{ url('/movies/4') }}" class="btn btn-sm btn-outline-light mt-auto">Xem Chi Tiết</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection