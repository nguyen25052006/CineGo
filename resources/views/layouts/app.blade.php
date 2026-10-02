<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineGo - Đặt Vé Xem Phim Trực Tuyến')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-cinego {
            background-color: #1e293b;
            border-bottom: 1px solid #334155;
        }

        .brand-logo {
            font-weight: 800;
            letter-spacing: 1px;
            color: #e11d48 !important;
        }

        .brand-logo span {
            color: #f8fafc;
        }

        .card-custom {
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #f8fafc;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .footer-cinego {
            background-color: #1e293b;
            border-top: 1px solid #334155;
            margin-top: auto;
        }

        .btn-cinego {
            background-color: #e11d48;
            color: #fff;
            border: none;
        }

        .btn-cinego:hover {
            background-color: #be123c;
            color: #fff;
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-cinego sticky-top">
        <div class="container">
            <a class="navbar-brand brand-logo fs-3" href="{{ url('/') }}">
                <i class="bi bi-film me-1"></i>Cine<span>Go</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active text-warning fw-bold' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i>Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('movies*') ? 'active text-warning fw-bold' : '' }}" href="{{ url('/movies') }}">
                            <i class="bi bi-collection-play me-1"></i>Danh sách phim
                        </a>
                    </li>
                </ul>

                <!-- TÌM KIẾM NHANH -->
                <form class="d-flex me-3" action="{{ url('/movies') }}" method="GET">
                    <div class="input-group input-group-sm">
                        <input class="form-control bg-dark text-white border-secondary" type="search" name="search" placeholder="Tìm tên phim..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary text-white" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <!-- KHU VỰC USER / AUTH -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                    <!-- Đã đăng nhập -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 me-1 text-danger"></i>
                            {{ Auth::user()->name ?? 'Tài khoản' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/bookings/history') }}">
                                    <i class="bi bi-ticket-perforated me-2"></i>Vé của tôi
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-secondary">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- Khách / Chưa đăng nhập -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-cinego ms-2 px-3" href="{{ url('/register') }}">Đăng ký</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- KHU VỰC HIỂN THỊ THÔNG BÁO FLASH MESSAGE -->
    <div class="container mt-3">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        @endif
    </div>

    <!-- PHẦN NỘI DUNG CHÍNH (CONTENT THAY ĐỔI TỪNG TRANG) -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-cinego py-4 text-secondary text-center text-md-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <span class="fs-5 fw-bold brand-logo">Cine<span>Go</span></span>
                    <p class="small mb-0 mt-1">Hệ thống đặt vé xem phim trực tuyến tiện lợi, nhanh chóng.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small mb-0">&copy; {{ date('Y') }} CineGo Team. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>