@extends('layouts.app')

@section('title', 'Vé Điện Tử - CineGo')

@section('content')
<div class="container py-2">
    <!-- NÚT QUAY LẠI -->
    <div class="mb-4 d-flex justify-content-between align-items-center d-print-none">
        <a href="{{ route('bookings.history') }}" class="btn btn-sm btn-outline-secondary text-white">
            <i class="bi bi-arrow-left me-1"></i> Quay lại vé của tôi
        </a>
        <button class="btn btn-sm btn-outline-light d-none d-md-inline-block" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> In vé
        </button>
    </div>

    <!-- KHUNG VÉ ĐIỆN TỬ (E-TICKET CARD) -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 col-lg-8">
            <div class="card card-custom rounded-4 overflow-hidden border-0 shadow-lg">
                <!-- Header của vé -->
                <div class="bg-danger text-white p-3 text-center position-relative">
                    <span class="fs-5 fw-bold brand-logo text-white !important">Cine<span class="text-white">Go</span> E-TICKET</span>
                    <p class="small mb-0 opacity-75">Vui lòng xuất trình vé này tại quầy soát vé rạp phim</p>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4 align-items-center">
                        <!-- Thông tin phim & rạp -->
                        <div class="col-md-7 border-end-md border-secondary pe-md-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-danger">{{ $booking->movie_age_rating ?? 'T18' }}</span>
                                <span class="badge bg-secondary">{{ $booking->format ?? '2D Phụ Đề' }}</span>
                            </div>
                            <h3 class="fw-bold text-white mb-3">{{ $booking->movie_title ?? 'Chiến Binh Ánh Sáng' }}</h3>

                            <div class="row g-2 small text-secondary mb-3">
                                <div class="col-6">
                                    <span class="d-block">Rạp:</span>
                                    <strong class="text-white">{{ $booking->cinema_name ?? 'CineGo Tân Phú' }}</strong>
                                </div>
                                <div class="col-6">
                                    <span class="d-block">Phòng chiếu:</span>
                                    <strong class="text-white">{{ $booking->room_name ?? 'Phòng 01' }}</strong>
                                </div>
                                <div class="col-6">
                                    <span class="d-block">Suất chiếu:</span>
                                    <strong class="text-white">{{ $booking->show_time ?? '18:30 - Hôm nay' }}</strong>
                                </div>
                                <div class="col-6">
                                    <span class="d-block">Ghế ngồi:</span>
                                    <strong class="text-warning fs-6">{{ $booking->seats ?? 'H08, H09' }}</strong>
                                </div>
                            </div>

                            <div class="pt-3 border-top border-secondary">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-secondary small">Tổng tiền thanh toán:</span>
                                    <span class="fs-4 fw-bold text-danger">{{ number_format($booking->total_price ?? 90000, 0, ',', '.') }}đ</span>
                                </div>
                            </div>
                        </div>

                        <!-- Cột Mã QR & Mã soát vé -->
                        <div class="col-md-5 text-center">
                            <div class="bg-white p-3 d-inline-block rounded-3 shadow-sm mb-2">
                                <!-- Tạo mã QR mẫu trực quan từ API QuickChart -->
                                <img src="https://quickchart.io/qr?text=CINEGO-{{ $booking->code ?? '88291' }}&size=160" alt="QR Code" class="img-fluid" style="width: 150px; height: 150px;">
                            </div>
                            <div class="text-secondary small">Mã vé (Booking ID):</div>
                            <div class="fs-5 fw-bold text-warning letter-spacing-1">#CG-{{ $booking->code ?? '88291' }}</div>
                            <div class="mt-2">
                                <span class="badge bg-success"><i class="bi bi-check2-circle me-1"></i>Thanh toán thành công</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer của vé -->
                <div class="card-footer bg-dark border-top border-secondary text-secondary small text-center py-3">
                    <i class="bi bi-info-circle me-1"></i> Có mặt tại rạp trước giờ chiếu ít nhất 15 phút. Chúc bạn xem phim vui vẻ!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection