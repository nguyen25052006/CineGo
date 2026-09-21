@extends('layouts.app')

@section('title', ($movie->title ?? 'Chi Tiết Phim') . ' - CineGo')

@section('content')
<div class="container py-2">
    <!-- NÚT QUAY LẠI -->
    <a href="{{ route('movies.index') }}" class="btn btn-sm btn-outline-secondary mb-4 text-white">
        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
    </a>

    <!-- KHỐI THÔNG TIN CHI TIẾT PHIM -->
    <div class="row g-4 mb-5">
        <!-- Cột Poster -->
        <div class="col-md-4 col-lg-3">
            <div class="card card-custom overflow-hidden rounded-3 shadow">
                <img src="{{ $movie->poster_url ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=600' }}"
                    class="img-fluid w-100"
                    alt="{{ $movie->title ?? 'Poster phim' }}"
                    style="object-fit: cover; max-height: 450px;">
            </div>
        </div>

        <!-- Cột Thông tin chi tiết -->
        <div class="col-md-8 col-lg-9">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <span class="badge bg-danger px-2 py-1">{{ $movie->age_rating ?? 'T18' }}</span>
                <span class="badge bg-secondary px-2 py-1">{{ $movie->genre ?? 'Hành Động, Viễn Tưởng' }}</span>
                <span class="text-warning fw-bold"><i class="bi bi-star-fill me-1"></i>{{ $movie->rating ?? '8.8' }}/10</span>
            </div>

            <h2 class="display-6 fw-bold mb-3">{{ $movie->title ?? 'Chiến Binh Ánh Sáng' }}</h2>

            <p class="text-light lead fs-6 mb-4">
                {{ $movie->description ?? 'Bộ phim kể về hành trình đầy kịch tính của các chiến binh trong cuộc chiến bảo vệ Trái Đất trước các thế lực bóng tối đến từ đa vũ trụ. Tác phẩm sở hữu kỹ xảo mãn nhãn cùng dàn âm thanh sống động chuẩn rạp chiếu.' }}
            </p>

            <div class="row g-3 mb-4 text-secondary small">
                <div class="col-sm-6">
                    <p class="mb-1"><strong class="text-white">Thời lượng:</strong> {{ $movie->duration ?? 120 }} phút</p>
                    <p class="mb-1"><strong class="text-white">Đạo diễn:</strong> {{ $movie->director ?? 'Christopher Nolan' }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-1"><strong class="text-white">Khởi chiếu:</strong> {{ isset($movie->release_date) ? date('d/m/Y', strtotime($movie->release_date)) : '25/10/2026' }}</p>
                    <p class="mb-1"><strong class="text-white">Ngôn ngữ:</strong> {{ $movie->language ?? 'Tiếng Anh - Phụ đề Tiếng Việt' }}</p>
                </div>
            </div>

            <!-- Nút xem Trailer nhanh -->
            @if(!empty($movie->trailer_url) || true)
            <button class="btn btn-outline-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#trailerModal">
                <i class="bi bi-play-circle-fill me-1"></i> Xem Trailer
            </button>
            @endif
        </div>
    </div>

    <!-- KHỐI CHỌN SUẤT CHIẾU (SHOWTIMES) -->
    <div class="card card-custom p-4 rounded-3 mb-5">
        <h4 class="fw-bold border-start border-4 border-danger ps-3 mb-4">Lịch Chiếu & Đặt Vé</h4>

        <!-- Chọn ngày xem -->
        <div class="d-flex gap-2 overflow-auto pb-3 mb-4">
            <button class="btn btn-cinego text-nowrap px-3 py-2">
                <div class="fw-bold">Hôm nay</div>
                <small>21/09</small>
            </button>
            <button class="btn btn-outline-secondary text-white text-nowrap px-3 py-2">
                <div class="fw-bold">Thứ 3</div>
                <small>22/09</small>
            </button>
            <button class="btn btn-outline-secondary text-white text-nowrap px-3 py-2">
                <div class="fw-bold">Thứ 4</div>
                <small>23/09</small>
            </button>
            <button class="btn btn-outline-secondary text-white text-nowrap px-3 py-2">
                <div class="fw-bold">Thứ 5</div>
                <small>24/09</small>
            </button>
        </div>

        <!-- Danh sách suất chiếu theo định dạng phòng -->
        <div class="mb-4">
            <h6 class="text-warning fw-bold mb-3"><i class="bi bi-display me-2"></i>Định dạng 2D Phụ Đề</h6>
            <div class="d-flex flex-wrap gap-2">
                @if(isset($showtimes) && count($showtimes) > 0)
                @foreach($showtimes as $st)
                <a href="{{ route('bookings.create', $st->id) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">{{ date('H:i', strtotime($st->start_time)) }}</span>
                    <small class="d-block text-secondary">{{ $st->room_name ?? 'Phòng chiếu' }}</small>
                </a>
                @endforeach
                @else
                <!-- Suất chiếu mockup khi chưa có database -->
                <a href="{{ route('bookings.create', 1) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">09:30</span>
                    <small class="d-block text-secondary">Phòng 01</small>
                </a>
                <a href="{{ route('bookings.create', 2) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">13:15</span>
                    <small class="d-block text-secondary">Phòng 02</small>
                </a>
                <a href="{{ route('bookings.create', 3) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">16:45</span>
                    <small class="d-block text-secondary">Phòng 01</small>
                </a>
                <a href="{{ route('bookings.create', 4) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">20:00</span>
                    <small class="d-block text-secondary">Phòng 03</small>
                </a>
                @endif
            </div>
        </div>

        <div>
            <h6 class="text-warning fw-bold mb-3"><i class="bi bi-badge-3d me-2"></i>Định dạng 3D IMAX</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('bookings.create', 5) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">18:30</span>
                    <small class="d-block text-secondary">Phòng IMAX</small>
                </a>
                <a href="{{ route('bookings.create', 6) }}" class="btn btn-outline-light px-3 py-2">
                    <span class="fw-bold">21:45</span>
                    <small class="d-block text-secondary">Phòng IMAX</small>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL POPUP TRAILER -->
<div class="modal fade" id="trailerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-white">Trailer: {{ $movie->title ?? 'Chiến Binh Ánh Sáng' }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $movie->trailer_url ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ' }}" title="Trailer" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection