<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Phim CineGo</title>
    <!-- Nhúng Bootstrap 5 CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- Nhúng FontAwesome sử dụng Icon -->
    <link href="https://cloudflare.com" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <!-- Khối Tiêu đề -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex justify-content-between align-items-center bg-white rounded">
                <h3 class="m-0 text-primary fw-bold">
                    <i class="fa-solid fa-clapperboard me-2"></i>HỆ THỐNG QUẢN LÝ PHIM CINEGO
                </h3>
                <!-- Nút Thêm Phim Mới -->
                <a href="/admin/movies/create" class="btn btn-success fw-semibold shadow-sm">
                    <i class="fa-solid fa-circle-plus me-2"></i>Thêm Phim Mới
                </a>
            </div>
        </div>

        <!-- Khối Tìm kiếm phim -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body bg-white rounded">
                <form action="/admin/movies" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Tìm kiếm phim theo tên..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 fw-semibold">Tìm Kiếm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Khối Bảng Danh Sách Phim -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0 rounded bg-white overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center" style="width: 70px;">STT</th>
                                <th scope="col" style="width: 110px;">Poster</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col" style="width: 160px;">Trạng thái</th>
                                <th scope="col" class="text-center" style="width: 220px;">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($movies) && $movies->count() > 0)
                                @foreach($movies as $key => $movie)
                                    <tr>
                                        <td class="text-center fw-semibold text-secondary">{{ $key + 1 }}</td>
                                        <td>
                                            @if($movie->poster)
                                                <img src="{{ $movie->poster }}" alt="Poster" class="img-thumbnail rounded shadow-sm" style="height: 75px; width: 55px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded text-center text-muted border py-3 fw-light" style="font-size: 11px;">No Image</div>
                                            @endif
                                        </td>
                                        <td class="fw-bold text-dark">{{ $movie->title }}</td>
                                        <td><span class="badge bg-light text-dark border fw-medium">{{ $movie->genre }}</span></td>
                                        <td>
                                            @if($movie->status == 'showing')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Đang chiếu</span>
                                            @elseif($movie->status == 'coming_soon')
                                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">Sắp chiếu</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-1">Đã kết thúc</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/admin/movies/{{ $movie->id }}/edit" class="btn btn-sm btn-outline-warning">Sửa</a>
                                                <form action="/admin/movies/{{ $movie->id }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bộ phim này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fa-regular fa-folder-open fa-3x mb-3 text-body-tertiary d-block"></i>
                                        <span class="d-block fw-medium">Chưa có bộ phim nào được tạo.</span>
                                        <small class="text-secondary">Bấm nút <strong>Thêm phim mới</strong> để bắt đầu dữ liệu đầu tiên!</small>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Nhúng Bootstrap 5 Javascript -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>
