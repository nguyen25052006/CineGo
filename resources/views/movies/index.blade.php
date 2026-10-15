@extends('layouts.admin')

@section('title', 'Quản lý phim | CineGo')
@section('page_title', 'Quản lý phim')

@section('content')

    <!-- TIÊU ĐỀ TRANG -->
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <div class="page-label">Thư viện phim</div>

            <h2 class="page-heading">Danh sách phim</h2>

            <p class="page-description">
                Theo dõi và quản lý danh sách phim trong hệ thống CineGo.
            </p>
        </div>

        <a href="{{ route('admin.movies.create') }}"
           class="btn-cinego">

            <i class="bi bi-plus-lg"></i>
            Thêm phim mới

        </a>

    </div>


    <!-- THỐNG KÊ -->
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card stat-card">

                <div>
                    <div class="stat-label">Số kết quả tìm thấy</div>

                    <div class="stat-number">
                        {{ $movies->total() }}
                    </div>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-film"></i>
                </div>

            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card stat-card">

                <div>
                    <div class="stat-label">Phim trên trang này</div>

                    <div class="stat-number">
                        {{ $movies->count() }}
                    </div>
                </div>

                <div class="stat-icon"
                     style="background:#dbeafe;color:#2563eb;">
                    <i class="bi bi-collection"></i>
                </div>

            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card stat-card">

                <div>
                    <div class="stat-label">Trang hiện tại</div>

                    <div class="stat-number">
                        {{ $movies->currentPage() }}
                        <span class="fs-6 text-secondary">
                            / {{ $movies->lastPage() }}
                        </span>
                    </div>
                </div>

                <div class="stat-icon"
                     style="background:#fef3c7;color:#a16207;">
                    <i class="bi bi-files"></i>
                </div>

            </div>
        </div>

    </div>


    <!-- TÌM KIẾM -->
    <div class="admin-card p-3 p-md-4 mb-4">

        <form action="{{ route('admin.movies.index') }}"
              method="GET"
              class="row g-3 align-items-end">

            <div class="col-12 col-md-8">

                <label for="search"
                       class="form-label fw-bold small">
                    Tìm kiếm phim
                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white"
                          style="border-color:#dfe4ed;">
                        <i class="bi bi-search text-secondary"></i>
                    </span>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control"
                        placeholder="Nhập tên phim cần tìm..."
                        value="{{ request('search') }}"
                    >

                </div>

            </div>

            <div class="col-6 col-md-2">

                <button type="submit"
                        class="btn-cinego w-100">

                    <i class="bi bi-search"></i>
                    Tìm kiếm

                </button>

            </div>

            <div class="col-6 col-md-2">

                <a href="{{ route('admin.movies.index') }}"
                   class="btn-admin-light w-100">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Làm mới

                </a>

            </div>

        </form>

    </div>


    <!-- BẢNG PHIM -->
    <div class="admin-card overflow-hidden">

        <div class="d-flex flex-wrap justify-content-between
                    align-items-center gap-2 p-3 p-md-4
                    border-bottom">

            <div>
                <h5 class="fw-bold mb-1">
                    <i class="bi bi-list-ul me-2"
                       style="color:#e11d48;"></i>
                    Kho phim CineGo
                </h5>

                <p class="text-secondary small mb-0">
                    Danh sách phim được lấy từ cơ sở dữ liệu.
                </p>
            </div>

            <span class="badge rounded-pill text-bg-light border px-3 py-2">
                {{ $movies->total() }} phim
            </span>

        </div>


        <div class="table-responsive">

            <table class="table movie-table align-middle">

                <thead>
                    <tr>
                        <th style="width:65px;">STT</th>
                        <th style="min-width:250px;">Thông tin phim</th>
                        <th>Thể loại</th>
                        <th>Thời lượng</th>
                        <th>Khởi chiếu</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($movies as $key => $movie)

                        <tr>

                            <!-- STT -->
                            <td class="text-secondary fw-semibold">
                                {{ $movies->firstItem() + $key }}
                            </td>


                            <!-- POSTER VÀ TÊN PHIM -->
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($movie->poster)

                                        <img
                                            src="{{ $movie->poster }}"
                                            alt="{{ $movie->title }}"
                                            class="movie-poster"
                                        >

                                    @else

                                        <div class="movie-poster d-flex
                                                    align-items-center
                                                    justify-content-center">

                                            <i class="bi bi-film fs-3
                                                      text-secondary"></i>

                                        </div>

                                    @endif

                                    <div>
                                        <div class="movie-title">
                                            {{ $movie->title }}
                                        </div>

                                        <div class="movie-id">
                                            Mã phim: #{{ $movie->id }}
                                        </div>
                                    </div>

                                </div>

                            </td>


                            <!-- THỂ LOẠI -->
                            <td>
                                <span class="badge rounded-pill
                                             text-bg-light border
                                             px-3 py-2">

                                    {{ $movie->genre }}

                                </span>
                            </td>


                            <!-- THỜI LƯỢNG -->
                            <td class="text-nowrap">

                                <i class="bi bi-clock me-1
                                          text-secondary"></i>

                                {{ $movie->duration_minutes }} phút

                            </td>


                            <!-- NGÀY KHỞI CHIẾU -->
                            <td class="text-nowrap">

                                @if($movie->release_date)
                                    {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}
                                @else
                                    <span class="text-secondary">Chưa có</span>
                                @endif

                            </td>


                            <!-- TRẠNG THÁI -->
                            <td>

                                @if($movie->status == 'showing')

                                    <span class="status-badge status-showing">
                                        <i class="bi bi-circle-fill"
                                           style="font-size:7px;"></i>
                                        Đang chiếu
                                    </span>

                                @elseif($movie->status == 'coming_soon')

                                    <span class="status-badge status-coming">
                                        <i class="bi bi-clock"
                                           style="font-size:12px;"></i>
                                        Sắp chiếu
                                    </span>

                                @else

                                    <span class="status-badge status-ended">
                                        <i class="bi bi-check-circle"
                                           style="font-size:12px;"></i>
                                        Đã kết thúc
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-film"></i>
                                    </div>

                                    <h5 class="fw-bold mb-2">
                                        @if(request('search'))
                                            Không tìm thấy phim phù hợp
                                        @else
                                            Kho phim đang trống
                                        @endif
                                    </h5>

                                    <p class="text-secondary mb-4">
                                        @if(request('search'))
                                            Hãy thử tìm bằng một tên phim khác.
                                        @else
                                            Bạn chưa thêm phim nào vào CineGo.
                                            Hãy tạo bộ phim đầu tiên của mình.
                                        @endif
                                    </p>

                                    @if(request('search'))

                                        <a href="{{ route('admin.movies.index') }}"
                                           class="btn-admin-light">
                                            Xóa bộ lọc
                                        </a>

                                    @else

                                        <a href="{{ route('admin.movies.create') }}"
                                           class="btn-cinego">

                                            <i class="bi bi-plus-lg"></i>
                                            Thêm phim đầu tiên

                                        </a>

                                    @endif

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PHÂN TRANG -->
        @if($movies->hasPages())

            <div class="d-flex flex-wrap justify-content-between
                        align-items-center gap-3 p-3 p-md-4
                        border-top">

                <small class="text-secondary">
                    Hiển thị {{ $movies->firstItem() }}
                    – {{ $movies->lastItem() }}
                    trong {{ $movies->total() }} kết quả
                </small>

                {{ $movies->withQueryString()->links() }}

            </div>

        @endif

    </div>

@endsection