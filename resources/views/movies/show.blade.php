@extends('layouts.app')

@section('title', ($movie->title ?? 'Chi Tiết Phim') . ' - CineGo')

@section('content')
<div class="container py-2">
    <!-- NÚT QUAY LẠI -->
    <a href="{{ route('movies.index') }}"
        class="btn btn-sm btn-outline-secondary mb-4 text-white">
        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
    </a>

    <!-- KHỐI THÔNG TIN CHI TIẾT PHIM -->
    <div class="row g-4 mb-5">
        <!-- Cột Poster -->
        <div class="col-md-4 col-lg-3">
            <div class="card card-custom overflow-hidden rounded-3 shadow">
                <img src="{{ $movie->poster ?: 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=600' }}"
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
                    <p class="mb-1"><strong class="text-white">Thời lượng:</strong> {{ $movie->duration_minutes }} phút</p>
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

    ```blade
    <!-- LỊCH CHIẾU THẬT CỦA PHIM -->

    <div class="card card-custom p-4 rounded-3 mb-5">

        <h4 class="fw-bold border-start border-4 border-danger ps-3 mb-4">
            Lịch Chiếu & Đặt Vé
        </h4>

        @if($showtimes->isEmpty())

        <p class="text-secondary mb-0">
            Phim hiện chưa có suất chiếu phù hợp.
            Vui lòng quay lại sau.
        </p>

        @else

        @php
        $showtimesByDate = $showtimes->groupBy(function ($st) {
        return $st->show_date->format('Y-m-d');
        });
        @endphp

        @foreach($showtimesByDate as $date => $dayShowtimes)

        <h6 class="text-warning fw-bold mt-3 mb-3">
            Ngày {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
        </h6>

        <div class="d-flex flex-wrap gap-2 mb-3">

            @foreach($dayShowtimes as $st)

            @if($st->available_tickets > 0)

            <a
                href="{{ route('booking.create', $st->id) }}"
                class="btn btn-outline-light px-3 py-2">
                <span class="fw-bold">
                    {{ substr($st->start_time, 0, 5) }}
                </span>

                <small class="d-block text-secondary">
                    {{ $st->room_name }}
                </small>

                <small class="d-block text-warning">
                    {{ number_format((float) $st->ticket_price, 0, ',', '.') }}đ
                </small>
            </a>

            @else

            <button
                type="button"
                class="btn btn-outline-secondary px-3 py-2"
                disabled>
                {{ substr($st->start_time, 0, 5) }}
                <small class="d-block">Hết vé</small>
            </button>

            @endif

            @endforeach

        </div>

        @endforeach

        @endif

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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateButtons = document.querySelectorAll('.btn-date');
            const showtimeItems = document.querySelectorAll('.showtime-item');

            // Lọc hiển thị suất chiếu theo ngày
            function filterShowtimes(selectedDate) {
                showtimeItems.forEach(item => {
                    if (item.dataset.showdate === selectedDate) {
                        item.style.display = 'inline-block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Mặc định ban đầu chọn ngày đầu tiên (Hôm nay)
            if (dateButtons.length > 0) {
                filterShowtimes(dateButtons[0].dataset.date);
            }

            // Bắt sự kiện chọn ngày
            dateButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    dateButtons.forEach(b => {
                        b.classList.remove('btn-cinego');
                        b.classList.add('btn-outline-secondary', 'text-white');
                    });
                    this.classList.remove('btn-outline-secondary', 'text-white');
                    this.classList.add('btn-cinego');

                    filterShowtimes(this.dataset.date);
                });
            });
        });
    </script>
    @endpush