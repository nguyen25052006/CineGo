@extends('layouts.app')

@section('title', 'Lịch Sử Đặt Vé - CineGo')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Vé Của Tôi</h3>
            <p class="text-secondary small mb-0 mt-1">Các đơn đặt vé của tài khoản đang đăng nhập</p>
        </div>
        <a href="{{ route('movies.index') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Đặt thêm vé
        </a>
    </div>

    @forelse($bookings as $booking)
        @php
            $detail = $booking->bookingDetails->first();
            $showtime = $detail?->showtime;
            $movie = $showtime?->movie;
        @endphp

        <div class="card card-custom p-3 rounded-3 shadow-sm mb-3">
            <div class="row align-items-center g-3">
                <div class="col-md">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-1">
                        <span class="text-secondary small">Mã đặt vé:</span>
                        <strong class="text-warning">{{ $booking->booking_code }}</strong>
                        <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : 'bg-secondary' }}">
                            {{ \App\Models\Booking::STATUSES[$booking->status] ?? $booking->status }}
                        </span>
                    </div>

                    <h5 class="fw-bold text-white mb-2">{{ $movie->title ?? 'Phim không còn tồn tại' }}</h5>

                    <div class="small text-secondary d-flex flex-wrap gap-3">
                        <span><i class="bi bi-calendar-event text-warning me-1"></i>{{ optional($showtime?->show_date)->format('d/m/Y') ?: '-' }}</span>
                        <span><i class="bi bi-clock text-info me-1"></i>{{ $showtime ? substr($showtime->start_time, 0, 5) : '-' }}</span>
                        <span><i class="bi bi-door-open text-danger me-1"></i>{{ $showtime->room_name ?? '-' }}</span>
                        <span><i class="bi bi-ticket-perforated me-1"></i>{{ $detail->quantity ?? 0 }} vé</span>
                    </div>
                </div>

                <div class="col-md-auto text-md-end">
                    <div class="fs-5 fw-bold text-danger mb-2">
                        {{ number_format((float) $booking->total_amount, 0, ',', '.') }}đ
                    </div>
                    <a href="{{ route('booking.show', $booking) }}" class="btn btn-sm btn-outline-light px-3">
                        <i class="bi bi-eye me-1"></i> Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="card card-custom rounded-3 p-5 text-center">
            <i class="bi bi-ticket-perforated fs-1 text-secondary mb-3"></i>
            <h5>Bạn chưa có đơn đặt vé nào</h5>
            <p class="text-secondary">Chọn một phim và suất chiếu để bắt đầu đặt vé.</p>
            <div>
                <a href="{{ route('movies.index') }}" class="btn btn-cinego">Xem phim</a>
            </div>
        </div>
    @endforelse

    @if($bookings->hasPages())
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection
