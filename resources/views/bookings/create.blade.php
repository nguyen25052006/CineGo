@extends('layouts.app')

@section('title', 'Đặt Vé - ' . ($showtime->movie->title ?? 'CineGo'))

@section('content')
<div class="container py-2">
    <div class="mb-4">
        <a href="{{ route('movies.show', $showtime->movie_id) }}" class="btn btn-sm btn-outline-secondary mb-2 text-white">
            <i class="bi bi-arrow-left me-1"></i> Quay lại chi tiết phim
        </a>
        <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Đặt Vé Xem Phim</h3>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-custom p-4 rounded-3">
                <h5 class="fw-bold text-warning mb-3">
                    <i class="bi bi-ticket-perforated me-2"></i>Thông tin vé
                </h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                    @csrf
                    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Số lượng vé</label>
                        <input
                            type="number"
                            class="form-control bg-dark text-white border-secondary"
                            id="quantity"
                            name="quantity"
                            value="{{ old('quantity', 1) }}"
                            min="1"
                            max="{{ $showtime->available_tickets }}"
                            required
                        >
                        <div class="form-text text-secondary">
                            Còn {{ $showtime->available_tickets }} vé cho suất chiếu này.
                        </div>
                    </div>

                    <div class="d-grid">
                        <button
                            type="submit"
                            class="btn btn-cinego btn-lg"
                            {{ $showtime->available_tickets < 1 ? 'disabled' : '' }}
                        >
                            <i class="bi bi-check2-circle me-2"></i>Xác nhận đặt vé
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card card-custom p-4 rounded-3 sticky-top" style="top: 85px;">
                <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Tóm Tắt Đơn Hàng</h5>

                <div class="d-flex gap-3 mb-3">
                    @if(!empty($showtime->movie->poster))
                        <img src="{{ asset('storage/' . $showtime->movie->poster) }}" class="rounded" style="width: 76px; height: 105px; object-fit: cover;" alt="Poster">
                    @else
                        <div class="rounded bg-dark border border-secondary d-flex align-items-center justify-content-center" style="width: 76px; height: 105px;">
                            <i class="bi bi-film fs-2 text-secondary"></i>
                        </div>
                    @endif
                    <div>
                        <h6 class="fw-bold mb-1">{{ $showtime->movie->title ?? 'Phim' }}</h6>
                        <div class="small text-secondary">{{ $showtime->movie->genre ?? '' }}</div>
                        <div class="small text-secondary">
                            <i class="bi bi-clock me-1"></i>{{ $showtime->movie->duration_minutes ?? 0 }} phút
                        </div>
                    </div>
                </div>

                <div class="small text-secondary border-top border-bottom border-secondary py-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ngày chiếu:</span>
                        <strong class="text-white">{{ optional($showtime->show_date)->format('d/m/Y') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Giờ chiếu:</span>
                        <strong class="text-white">{{ substr($showtime->start_time, 0, 5) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phòng:</span>
                        <strong class="text-white">{{ $showtime->room_name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Giá 1 vé:</span>
                        <strong class="text-warning">{{ number_format((float) $showtime->ticket_price, 0, ',', '.') }}đ</strong>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span>Tổng tiền:</span>
                    <span class="fs-4 fw-bold text-danger" id="total-amount">
                        {{ number_format((float) $showtime->ticket_price, 0, ',', '.') }}đ
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const totalAmount = document.getElementById('total-amount');
    const unitPrice = {{ (float) $showtime->ticket_price }};

    function updateTotal() {
        const quantity = Math.max(0, parseInt(quantityInput.value || '0', 10));
        totalAmount.textContent = new Intl.NumberFormat('vi-VN').format(quantity * unitPrice) + 'đ';
    }

    quantityInput.addEventListener('input', updateTotal);
    updateTotal();
});
</script>
@endpush
