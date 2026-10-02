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

    <!-- KHỐI CHỌN SUẤT CHIẾU THEO NGÀY THỰC TẾ -->
    <div class="card card-custom p-4 rounded-3 mb-5">
        <h4 class="fw-bold border-start border-4 border-danger ps-3 mb-4">Lịch Chiếu & Đặt Vé</h4>

        @php
        $daysOfWeek = [
        'Mon' => 'Thứ 2',
        'Tue' => 'Thứ 3',
        'Wed' => 'Thứ 4',
        'Thu' => 'Thứ 5',
        'Fri' => 'Thứ 6',
        'Sat' => 'Thứ 7',
        'Sun' => 'Chủ nhật'
        ];

        // Mẫu suất chiếu khác nhau tùy theo từng thứ trong tuần
        $scheduleByDay = [
        'Mon' => [
        '2d' => [['time' => '10:00', 'room' => 'Phòng 01'], ['time' => '14:30', 'room' => 'Phòng 02'], ['time' => '19:00', 'room' => 'Phòng 01']],
        '3d' => [['time' => '20:15', 'room' => 'Phòng IMAX']]
        ],
        'Tue' => [
        '2d' => [['time' => '09:00', 'room' => 'Phòng 03'], ['time' => '13:00', 'room' => 'Phòng 01'], ['time' => '17:30', 'room' => 'Phòng 02'], ['time' => '21:00', 'room' => 'Phòng 01']],
        '3d' => [['time' => '18:00', 'room' => 'Phòng IMAX']]
        ],
        'Wed' => [
        '2d' => [['time' => '11:15', 'room' => 'Phòng 02'], ['time' => '15:45', 'room' => 'Phòng 01'], ['time' => '20:00', 'room' => 'Phòng 03']],
        '3d' => [['time' => '19:30', 'room' => 'Phòng IMAX'], ['time' => '22:15', 'room' => 'Phòng IMAX']]
        ],
        'Thu' => [
        '2d' => [['time' => '09:30', 'room' => 'Phòng 01'], ['time' => '14:00', 'room' => 'Phòng 02'], ['time' => '18:30', 'room' => 'Phòng 01']],
        '3d' => [['time' => '20:45', 'room' => 'Phòng IMAX']]
        ],
        'Fri' => [
        '2d' => [['time' => '10:30', 'room' => 'Phòng 01'], ['time' => '13:45', 'room' => 'Phòng 03'], ['time' => '17:00', 'room' => 'Phòng 02'], ['time' => '20:30', 'room' => 'Phòng 01'], ['time' => '22:45', 'room' => 'Phòng 02']],
        '3d' => [['time' => '18:15', 'room' => 'Phòng IMAX'], ['time' => '21:30', 'room' => 'Phòng IMAX']]
        ],
        'Sat' => [
        '2d' => [['time' => '08:30', 'room' => 'Phòng 01'], ['time' => '11:00', 'room' => 'Phòng 02'], ['time' => '14:15', 'room' => 'Phòng 03'], ['time' => '16:45', 'room' => 'Phòng 01'], ['time' => '19:30', 'room' => 'Phòng 02'], ['time' => '22:00', 'room' => 'Phòng 01']],
        '3d' => [['time' => '10:00', 'room' => 'Phòng IMAX'], ['time' => '15:30', 'room' => 'Phòng IMAX'], ['time' => '18:45', 'room' => 'Phòng IMAX'], ['time' => '21:45', 'room' => 'Phòng IMAX']]
        ],
        'Sun' => [
        '2d' => [['time' => '09:00', 'room' => 'Phòng 02'], ['time' => '11:45', 'room' => 'Phòng 01'], ['time' => '15:00', 'room' => 'Phòng 03'], ['time' => '18:00', 'room' => 'Phòng 01'], ['time' => '20:45', 'room' => 'Phòng 02']],
        '3d' => [['time' => '13:30', 'room' => 'Phòng IMAX'], ['time' => '17:15', 'room' => 'Phòng IMAX'], ['time' => '20:30', 'room' => 'Phòng IMAX']]
        ]
        ];
        @endphp

        <!-- 1. Thanh chọn ngày (7 ngày từ hôm nay) -->
        <div class="d-flex gap-2 overflow-auto pb-3 mb-4">
            @for ($i = 0; $i < 7; $i++)
                @php
                $timestamp=strtotime("+$i days");
                $fullDate=date('Y-m-d', $timestamp);
                $dayShort=date('D', $timestamp);
                $dayName=($i===0) ? 'Hôm nay' : ($daysOfWeek[$dayShort] ?? $dayShort);
                $dateFormat=date('d/m', $timestamp);
                @endphp

                <button type="button"
                class="btn btn-date text-nowrap px-3 py-2 {{ $i === 0 ? 'btn-cinego' : 'btn-outline-secondary text-white' }}"
                data-date="{{ $fullDate }}">
                <div class="fw-bold">{{ $dayName }}</div>
                <small>{{ $dateFormat }}</small>
                </button>
                @endfor
        </div>

        <!-- 2. Danh sách suất chiếu theo từng định dạng -->
        <div id="showtime-container">
            <!-- Nhóm 2D Phụ Đề -->
            <div class="mb-4">
                <h6 class="text-warning fw-bold mb-3"><i class="bi bi-display me-2"></i>Định dạng 2D Phụ Đề</h6>
                <div class="d-flex flex-wrap gap-2">
                    @if(isset($showtimes) && count($showtimes) > 0)
                    {{-- Khi có dữ liệu DB thật từ Controller truyền qua --}}
                    @foreach($showtimes as $st)
                    <a href="{{ route('bookings.create', $st->id) }}"
                        class="btn btn-outline-light px-3 py-2 showtime-item"
                        data-showdate="{{ date('Y-m-d', strtotime($st->start_time)) }}">
                        <span class="fw-bold">{{ date('H:i', strtotime($st->start_time)) }}</span>
                        <small class="d-block text-secondary">{{ $st->room_name ?? 'Phòng chiếu' }}</small>
                    </a>
                    @endforeach
                    @else
                    {{-- Suất chiếu tự động tùy biến theo từng thứ trong tuần --}}
                    @for ($i = 0; $i < 7; $i++)
                        @php
                        $currentTimestamp=strtotime("+$i days");
                        $dateKey=date('Y-m-d', $currentTimestamp);
                        $dayShort=date('D', $currentTimestamp);
                        $slots2D=$scheduleByDay[$dayShort]['2d'] ?? [];
                        @endphp
                        @foreach ($slots2D as $slot)
                        <a href="{{ route('bookings.create', 1) }}"
                        class="btn btn-outline-light px-3 py-2 showtime-item"
                        data-showdate="{{ $dateKey }}">
                        <span class="fw-bold">{{ $slot['time'] }}</span>
                        <small class="d-block text-secondary">{{ $slot['room'] }}</small>
                        </a>
                        @endforeach
                        @endfor
                        @endif
                </div>
            </div>

            <!-- Nhóm 3D IMAX -->
            <div>
                <h6 class="text-warning fw-bold mb-3"><i class="bi bi-badge-3d me-2"></i>Định dạng 3D IMAX</h6>
                <div class="d-flex flex-wrap gap-2">
                    @if(!isset($showtimes) || count($showtimes) === 0)
                    @for ($i = 0; $i < 7; $i++)
                        @php
                        $currentTimestamp=strtotime("+$i days");
                        $dateKey=date('Y-m-d', $currentTimestamp);
                        $dayShort=date('D', $currentTimestamp);
                        $slots3D=$scheduleByDay[$dayShort]['3d'] ?? [];
                        @endphp
                        @foreach ($slots3D as $slot)
                        <a href="{{ route('bookings.create', 2) }}"
                        class="btn btn-outline-light px-3 py-2 showtime-item"
                        data-showdate="{{ $dateKey }}">
                        <span class="fw-bold">{{ $slot['time'] }}</span>
                        <small class="d-block text-secondary">{{ $slot['room'] }}</small>
                        </a>
                        @endforeach
                        @endfor
                        @endif
                </div>
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