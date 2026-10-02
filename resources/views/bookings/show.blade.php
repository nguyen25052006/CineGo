@extends('layouts.app')

@section('title', 'Chi Tiết Đặt Vé - CineGo')

@section('content')
@php
    $detail = $booking->bookingDetails->first();
    $showtime = $detail?->showtime;
    $movie = $showtime?->movie;
@endphp

<div class="container py-2">
    <div class="mb-4 d-flex justify-content-between align-items-center d-print-none">
        <a href="{{ route('booking.history') }}" class="btn btn-sm btn-outline-secondary text-white">
            <i class="bi bi-arrow-left me-1"></i> Quay lại lịch sử
        </a>
        <button class="btn btn-sm btn-outline-light" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> In thông tin
        </button>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card card-custom rounded-4 overflow-hidden border-0 shadow-lg">
                <div class="bg-danger text-white p-3 text-center">
                    <span class="fs-5 fw-bold">CineGo - XÁC NHẬN ĐẶT VÉ</span>
                </div>

                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="text-secondary small">Mã đặt vé</div>
                        <div class="fs-3 fw-bold text-warning">{{ $booking->booking_code }}</div>
                        <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : 'bg-secondary' }}">
                            {{ \App\Models\Booking::STATUSES[$booking->status] ?? $booking->status }}
                        </span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Phim</span>
                            <strong>{{ $movie->title ?? '-' }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Phòng chiếu</span>
                            <strong>{{ $showtime->room_name ?? '-' }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Ngày chiếu</span>
                            <strong>{{ optional($showtime?->show_date)->format('d/m/Y') ?: '-' }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Giờ chiếu</span>
                            <strong>{{ $showtime ? substr($showtime->start_time, 0, 5) : '-' }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Số lượng</span>
                            <strong>{{ $detail->quantity ?? 0 }} vé</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Đơn giá</span>
                            <strong>{{ number_format((float) ($detail->unit_price ?? 0), 0, ',', '.') }}đ</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Thời điểm đặt</span>
                            <strong>{{ optional($booking->booked_at)->format('d/m/Y H:i') }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="d-block text-secondary small">Thành tiền</span>
                            <strong>{{ number_format((float) ($detail->subtotal ?? 0), 0, ',', '.') }}đ</strong>
                        </div>
                    </div>

                    <div class="border-top border-secondary pt-3 d-flex justify-content-between align-items-center">
                        <span class="text-secondary">Tổng tiền</span>
                        <span class="fs-3 fw-bold text-danger">{{ number_format((float) $booking->total_amount, 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <div class="card-footer bg-dark border-top border-secondary text-secondary small text-center py-3">
                    Vui lòng lưu mã đặt vé để đối chiếu khi cần.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
