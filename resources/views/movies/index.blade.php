@extends('layouts.app')

@section('title', 'CineGo - Danh Sách Phim Chiếu Rạp')

@section('content')
<div class="container">
    <!-- TIÊU ĐỀ & THANH LỌC / TÌM KIẾM -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-5">
            <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Danh Sách Phim</h3>
            <p class="text-secondary small mb-0 mt-1">Cập nhật những bộ phim bom tấn mới nhất tại hệ thống rạp CineGo</p>
        </div>
        <div class="col-md-7">
            <form action="{{ url('/movies') }}" method="GET" class="row g-2 justify-content-md-end">
                <!-- Lọc theo thể loại -->
                <div class="col-auto">
                    <select name="genre" class="form-select bg-dark text-white border-secondary">
                        <option value="">Tất cả thể loại</option>
                        <option value="action" {{ request('genre') == 'action' ? 'selected' : '' }}>Hành Động</option>
                        <option value="horror" {{ request('genre') == 'horror' ? 'selected' : '' }}>Kinh Dị</option>
                        <option value="comedy" {{ request('genre') == 'comedy' ? 'selected' : '' }}>Hài Hước</option>
                        <option value="sci-fi" {{ request('genre') == 'sci-fi' ? 'selected' : '' }}>Khoa Học Viễn Tưởng</option>
                        <option value="romance" {{ request('genre') == 'romance' ? 'selected' : '' }}>Tình Cảm</option>
                    </select>
                </div>
                <!-- Ô tìm kiếm -->
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Tên phim..." value="{{ request('search') }}">
                        <button class="btn btn-cinego" type="submit">
                            <i class="bi bi-funnel-fill me-1"></i> Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DANH SÁCH THẺ PHIM (GRID MOCKUP) -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
        <!-- Phim 1 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger">T18</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-danger small fw-bold mb-1">Hành Động, Viễn Tưởng</span>
                    <h5 class="card-title fw-bold text-truncate" title="Chiến Binh Ánh Sáng">Chiến Binh Ánh Sáng</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>120 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>8.8</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/1') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phim 2 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-primary">T13</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-primary small fw-bold mb-1">Khoa Học Viễn Tưởng</span>
                    <h5 class="card-title fw-bold text-truncate" title="Vũ Trụ Vô Tận">Vũ Trụ Vô Tận</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>145 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>9.0</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/2') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phim 3 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-success">P - Mọi lứa tuổi</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-warning small fw-bold mb-1">Hài Hước, Phiêu Lưu</span>
                    <h5 class="card-title fw-bold text-truncate" title="Chuyến Đi Bất Ổn">Chuyến Đi Bất Ổn</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>98 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>7.9</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/3') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phim 4 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger">T18</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-danger small fw-bold mb-1">Kinh Dị, Giật Gân</span>
                    <h5 class="card-title fw-bold text-truncate" title="Đêm Không Ngủ">Đêm Không Ngủ</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>105 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>8.2</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/4') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phim 5 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1478720568477-152d9b164e26?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-primary">T16</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-info small fw-bold mb-1">Bí Ẩn, Tội Phạm</span>
                    <h5 class="card-title fw-bold text-truncate" title="Mật Mã Vô Hình">Mật Mã Vô Hình</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>115 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>8.5</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/5') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phim 6 -->
        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=500" class="card-img-top" alt="Poster" style="height: 340px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-success">P - Mọi lứa tuổi</span>
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="text-warning small fw-bold mb-1">Hoạt Hình, Gia Đình</span>
                    <h5 class="card-title fw-bold text-truncate" title="Xứ Sở Thần Tiên">Xứ Sở Thần Tiên</h5>
                    <div class="d-flex justify-content-between text-secondary small mb-3">
                        <span><i class="bi bi-clock me-1"></i>92 phút</span>
                        <span><i class="bi bi-star-fill text-warning me-1"></i>8.9</span>
                    </div>
                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ url('/movies/6') }}" class="btn btn-sm btn-outline-light">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHÂN TRANG (PAGINATION MOCKUP) -->
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item disabled"><a class="page-link bg-dark text-secondary border-secondary" href="#">Trước</a></li>
            <li class="page-item active"><a class="page-link bg-danger text-white border-danger" href="#">1</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-secondary" href="#">2</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-secondary" href="#">3</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-secondary" href="#">Sau</a></li>
        </ul>
    </nav>
</div>
@endsection