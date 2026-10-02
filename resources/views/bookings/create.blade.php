@extends('layouts.app')

@section('title', 'Đặt Vé - ' . ($movie->title ?? 'Chiến Binh Ánh Sáng') . ' - CineGo')

@section('content')
<div class="container py-2">
    <!-- TIÊU ĐỀ BƯỚC ĐẶT VÉ -->
    <div class="mb-4">
        <a href="{{ route('movies.show', $movie->id ?? 1) }}" class="btn btn-sm btn-outline-secondary mb-2 text-white">
            <i class="bi bi-arrow-left me-1"></i> Quay lại chi tiết phim
        </a>
        <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Đặt Vé Xem Phim</h3>
    </div>

    <div class="row g-4">
        <!-- CỘT BÊN TRÁI: FORM CHỌN VÉ & BẮP NƯỚC -->
        <div class="col-lg-8">
            <form action="{{ route('bookings.history') }}" method="GET">
                <!-- THẺ CHỌN LOẠI VÉ -->
                <div class="card card-custom p-4 rounded-3 mb-4">
                    <h5 class="fw-bold mb-3 text-warning"><i class="bi bi-ticket-perforated me-2"></i>Chọn Loại Vé</h5>

                    <div class="table-responsive">
                        <table class="table table-dark table-borderless align-middle mb-0">
                            <thead>
                                <tr class="text-secondary border-bottom border-secondary small">
                                    <th>Loại vé</th>
                                    <th>Đơn giá</th>
                                    <th style="width: 140px;" class="text-center">Số lượng</th>
                                    <th class="text-end">Tạm tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Vé Người Lớn (Ghế Đơn)</div>
                                        <small class="text-secondary">Áp dụng cho mọi khách hàng</small>
                                    </td>
                                    <td><span class="text-light">90.000đ</span></td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary text-white btn-qty" type="button" data-action="minus" data-target="qty-standard">-</button>
                                            <input type="number" id="qty-standard" name="tickets[standard]" class="form-control text-center bg-dark text-white border-secondary qty-input" value="1" min="0" max="10" data-price="90000">
                                            <button class="btn btn-outline-secondary text-white btn-qty" type="button" data-action="plus" data-target="qty-standard">+</button>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold text-danger" id="subtotal-standard">90.000đ</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Vé Ghế VIP</div>
                                        <small class="text-secondary">Vị trí trung tâm góc nhìn hoàn hảo</small>
                                    </td>
                                    <td><span class="text-light">110.000đ</span></td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary text-white btn-qty" type="button" data-action="minus" data-target="qty-vip">-</button>
                                            <input type="number" id="qty-vip" name="tickets[vip]" class="form-control text-center bg-dark text-white border-secondary qty-input" value="0" min="0" max="10" data-price="110000">
                                            <button class="btn btn-outline-secondary text-white btn-qty" type="button" data-action="plus" data-target="qty-vip">+</button>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold text-danger" id="subtotal-vip">0đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- THẺ CHỌN COMBO BẮP NƯỚC -->
                <div class="card card-custom p-4 rounded-3 mb-4">
                    <h5 class="fw-bold mb-3 text-warning"><i class="bi bi-cup-straw me-2"></i>Combo Bắp & Nước (Tùy chọn)</h5>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 border border-secondary rounded-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">Combo Solo</h6>
                                    <small class="text-secondary d-block">1 Bắp ngọt + 1 Nước ngọt lớn</small>
                                    <span class="text-warning fw-bold">65.000đ</span>
                                </div>
                                <div style="width: 100px;">
                                    <input type="number" name="combos[solo]" class="form-control form-control-sm text-center bg-dark text-white border-secondary combo-input" value="0" min="0" max="5" data-price="65000">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 border border-secondary rounded-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">Combo Couple</h6>
                                    <small class="text-secondary d-block">1 Bắp lớn + 2 Nước ngọt lớn</small>
                                    <span class="text-warning fw-bold">95.000đ</span>
                                </div>
                                <div style="width: 100px;">
                                    <input type="number" name="combos[couple]" class="form-control form-control-sm text-center bg-dark text-white border-secondary combo-input" value="0" min="0" max="5" data-price="95000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CỘT NÚT XÁC NHẬN TRÊN MOBILE -->
                <div class="d-grid d-lg-none mb-4">
                    <button type="submit" class="btn btn-cinego btn-lg shadow">
                        <i class="bi bi-credit-card me-2"></i>Xác nhận thanh toán
                    </button>
                </div>
            </form>
        </div>

        <!-- CỘT BÊN PHẢI: TÓM TẮT ĐƠN ĐẶT CHỖ (ORDER SUMMARY) -->
        <div class="col-lg-4">
            <div class="card card-custom p-4 rounded-3 sticky-top" style="top: 85px;">
                <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Tóm Tắt Đơn Hàng</h5>

                <div class="d-flex gap-3 mb-3">
                    <img src="{{ $movie->poster_url ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=300' }}" class="rounded" style="width: 70px; height: 95px; object-fit: cover;" alt="Poster">
                    <div>
                        <h6 class="fw-bold mb-1 text-truncate" style="max-width: 180px;">{{ $movie->title ?? 'Chiến Binh Ánh Sáng' }}</h6>
                        <span class="badge bg-danger mb-1">{{ $movie->age_rating ?? 'T18' }}</span>
                        <div class="small text-secondary"><i class="bi bi-clock me-1"></i>{{ $movie->duration ?? 120 }} phút</div>
                    </div>
                </div>

                <div class="small text-secondary border-top border-bottom border-secondary py-3 mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Rạp chiếu:</span>
                        <strong class="text-white">CineGo Tân Phú</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Suất chiếu:</span>
                        <strong class="text-white">{{ $showtime->time ?? '18:30' }} - {{ $showtime->date ?? 'Hôm nay' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Phòng chiếu:</span>
                        <strong class="text-white">{{ $showtime->room ?? 'Phòng 01 (2D)' }}</strong>
                    </div>
                </div>

                <!-- TÍNH TỔNG TIỀN -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fs-6">Tổng thanh toán:</span>
                    <span class="fs-4 fw-bold text-danger" id="total-price">90.000đ</span>
                </div>

                <div class="d-grid">
                    <a href="{{ route('bookings.history') }}" class="btn btn-cinego btn-lg shadow">
                        <i class="bi bi-credit-card me-2"></i>Thanh toán ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // JS tính nhẩm tổng tiền trực tiếp trên UI
    function calculateTotal() {
        let total = 0;

        // Tính vé
        document.querySelectorAll('.qty-input').forEach(input => {
            const qty = parseInt(input.value) || 0;
            const price = parseInt(input.dataset.price) || 0;
            const subtotal = qty * price;
            total += subtotal;

            const subtotalEl = document.getElementById('subtotal-' + input.id.replace('qty-', ''));
            if (subtotalEl) {
                subtotalEl.innerText = subtotal.toLocaleString('vi-VN') + 'đ';
            }
        });

        // Tính combo
        document.querySelectorAll('.combo-input').forEach(input => {
            const qty = parseInt(input.value) || 0;
            const price = parseInt(input.dataset.price) || 0;
            total += (qty * price);
        });

        document.getElementById('total-price').innerText = total.toLocaleString('vi-VN') + 'đ';
    }

    // Nút tăng giảm số lượng
    document.querySelectorAll('.btn-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const action = this.dataset.action;
            const input = document.getElementById(targetId);
            let val = parseInt(input.value) || 0;

            if (action === 'plus' && val < 10) {
                input.value = val + 1;
            } else if (action === 'minus' && val > 0) {
                input.value = val - 1;
            }
            calculateTotal();
        });
    });

    document.querySelectorAll('.combo-input').forEach(input => {
        input.addEventListener('change', calculateTotal);
    });
</script>
@endpush
@endsection