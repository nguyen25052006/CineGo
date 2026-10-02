@extends('layouts.app')

@section('title', 'Lịch Sử Đặt Vé - CineGo')

@section('content')
<div class="container py-2">
    <!-- TIÊU ĐỀ TRANG -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Vé Của Tôi</h3>
            <p class="text-secondary small mb-0 mt-1">Danh sách vé xem phim bạn đã đặt tại CineGo</p>
        </div>
        <a href="{{ route('movies.index') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Đặt thêm vé
        </a>
    </div>

    <!-- DANH SÁCH VÉ -->
    <div class="row g-4 mb-5">
        @if(isset($bookings) && count($bookings) > 0)
        {{-- VÒNG LẶP KHI BACKEND TRUYỀN DỮ LIỆU THẬT --}}
        @foreach($bookings as $b)
        <div class="col-12">
            <div class="card card-custom p-3 rounded-3 shadow-sm">
                <div class="row align-items-center g-3">
                    <div class="col-auto">
                        <img src="{{ $b->movie_poster ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=200' }}"
                            class="rounded" style="width: 80px; height: 110px; object-fit: cover;" alt="Poster">
                    </div>
                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                            <span class="badge bg-danger">{{ $b->movie_age_rating ?? 'T18' }}</span>
                            <span class="text-secondary small">Mã đơn: <strong class="text-white">#CG-{{ $b->code ?? '1000' }}</strong></span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">{{ $b->movie_title ?? 'Tên Phim' }}</h5>
                        <div class="small text-secondary">
                            <span class="me-3"><i class="bi bi-geo-alt text-danger me-1"></i>{{ $b->cinema_name ?? 'CineGo Tân Phú' }}</span>
                            <span class="me-3"><i class="bi bi-calendar-event text-warning me-1"></i>{{ $b->show_time ?? '18:30 - 21/09/2026' }}</span>
                            <span><i class="bi bi-door-open text-info me-1"></i>{{ $b->room_name ?? 'Phòng 01' }}</span>
                        </div>
                    </div>
                    <div class="col-md-auto text-md-end border-top border-md-top-0 pt-2 pt-md-0 border-secondary">
                        <div class="mb-2">
                            <span class="badge bg-success"><i class="bi bi-check2-circle me-1"></i>Đã thanh toán</span>
                        </div>
                        <div class="fs-5 fw-bold text-danger mb-2">{{ number_format($b->total_price ?? 90000, 0, ',', '.') }}đ</div>
                        <a href="{{ route('bookings.show', $b->id ?? 1) }}" class="btn btn-sm btn-outline-light px-3">
                            <i class="bi bi-ticket-perforated me-1"></i> Chi tiết vé
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        {{-- DANH SÁCH MẪU HIỂN THỊ KHI CHƯA CÓ DATABASE --}}
        <!-- Vé Mẫu 1 -->
        <div class="col-12">
            <div class="card card-custom p-3 rounded-3 shadow-sm">
                <div class="row align-items-center g-3">
                    <div class="col-auto">
                        <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=200"
                            class="rounded" style="width: 80px; height: 110px; object-fit: cover;" alt="Poster">
                    </div>
                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                            <span class="badge bg-danger">T18</span>
                            <span class="text-secondary small">Mã đơn: <strong class="text-white">#CG-88291</strong></span>
                            <span class="badge bg-success ms-auto d-md-none"><i class="bi bi-check2-circle me-1"></i>Đã thanh toán</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Chiến Binh Ánh Sáng</h5>
                        <div class="small text-secondary">
                            <div class="mb-1"><i class="bi bi-geo-alt text-danger me-1"></i>CineGo Tân Phú - Phòng 01</div>
                            <div><i class="bi bi-calendar-event text-warning me-1"></i>Suất chiếu: <strong>18:30</strong> - Hôm nay (21/09/2026)</div>
                        </div>
                    </div>
                    <div class="col-md-auto text-md-end border-top border-md-top-0 pt-2 pt-md-0 border-secondary">
                        <div class="mb-2 d-none d-md-block">
                            <span class="badge bg-success"><i class="bi bi-check2-circle me-1"></i>Đã thanh toán</span>
                        </div>
                        <div class="fs-5 fw-bold text-danger mb-2">90.000đ</div>
                        <a href="{{ route('bookings.show', 1) }}" class="btn btn-sm btn-outline-light px-3">
                            <i class="bi bi-ticket-perforated me-1"></i> Xem vé
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vé Mẫu 2 -->
        <div class="col-12">
            <div class="card card-custom p-3 rounded-3 shadow-sm">
                <div class="row align-items-center g-3">
                    <div class="col-auto">
                        <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?q=80&w=200"
                            class="rounded" style="width: 80px; height: 110px; object-fit: cover;" alt="Poster">
                    </div>
                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                            <span class="badge bg-primary">T13</span>
                            <span class="text-secondary small">Mã đơn: <strong class="text-white">#CG-77102</strong></span>
                            <span class="badge bg-secondary ms-auto d-md-none"><i class="bi bi-clock-history me-1"></i>Đã sử dụng</span>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Vũ Trụ Vô Tận</h5>
                        <div class="small text-secondary">
                            <div class="mb-1"><i class="bi bi-geo-alt text-danger me-1"></i>CineGo Tân Phú - Phòng IMAX</div>
                            <div><i class="bi bi-calendar-event text-warning me-1"></i>Suất chiếu: <strong>20:15</strong> - 15/09/2026</div>
                        </div>
                    </div>
                    <div class="col-md-auto text-md-end border-top border-md-top-0 pt-2 pt-md-0 border-secondary">
                        <div class="mb-2 d-none d-md-block">
                            <span class="badge bg-secondary"><i class="bi bi-clock-history me-1"></i>Đã sử dụng</span>
                        </div>
                        <div class="fs-5 fw-bold text-secondary mb-2">155.000đ</div>
                        <a href="{{ route('bookings.show', 2) }}" class="btn btn-sm btn-outline-secondary text-white px-3">
                            <i class="bi bi-ticket-perforated me-1"></i> Chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection