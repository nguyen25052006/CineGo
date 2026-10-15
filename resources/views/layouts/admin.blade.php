<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Quản trị CineGo')</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --admin-sidebar: #111827;
            --admin-bg: #f4f6fb;
            --admin-accent: #e11d48;
            --admin-text: #1f2937;
            --admin-muted: #8490a3;
            --admin-border: #e8ebf2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        /* SIDEBAR */

        .admin-sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            width: 255px;
            padding: 26px 18px;
            background: var(--admin-sidebar);
            color: #fff;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            text-decoration: none;
            padding: 0 8px 28px;
        }

        .admin-brand:hover {
            color: #fff;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--admin-accent);
            border-radius: 14px;
            font-size: 25px;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .brand-subtitle {
            display: block;
            margin-top: 3px;
            color: #9ca3af;
            font-size: 10px;
            letter-spacing: 2px;
        }

        .sidebar-heading {
            margin: 12px 10px;
            color: #778196;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .admin-nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .admin-nav-link i {
            font-size: 18px;
        }

        .admin-nav-link:hover {
            background: #253044;
            color: #fff;
        }

        .admin-nav-link.active {
            background: var(--admin-accent);
            color: #fff;
            box-shadow: 0 5px 15px rgba(225, 29, 72, 0.2);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 24px;
            border-top: 1px solid #2d3748;
        }

        .admin-nav-button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            cursor: pointer;
        }

        /* MAIN */

        .admin-main {
            min-height: 100vh;
            margin-left: 255px;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            min-height: 84px;
            padding: 16px 32px;
            background: #fff;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .topbar-caption {
            margin-bottom: 4px;
            color: var(--admin-muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .topbar-title {
            margin: 0;
            font-size: 21px;
            font-weight: 750;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #ffe4eb;
            color: var(--admin-accent);
            border-radius: 50%;
            font-weight: 800;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 700;
        }

        .profile-role {
            color: var(--admin-muted);
            font-size: 11px;
        }

        .admin-content {
            padding: 30px 32px;
        }

        .page-label {
            margin-bottom: 8px;
            color: var(--admin-accent);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .page-heading {
            margin: 0 0 8px;
            font-size: clamp(23px, 3vw, 30px);
            font-weight: 800;
        }

        .page-description {
            margin: 0;
            color: var(--admin-muted);
            font-size: 14px;
        }

        /* CARDS AND TABLE */

        .admin-card {
            background: #fff;
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(31, 41, 55, 0.035);
        }

        .stat-card {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 20px;
        }

        .stat-label {
            color: var(--admin-muted);
            font-size: 12px;
        }

        .stat-number {
            margin-top: 7px;
            font-size: 25px;
            font-weight: 800;
        }

        .stat-icon {
            width: 47px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #ffe4eb;
            color: var(--admin-accent);
            font-size: 22px;
        }

        .admin-content .form-control,
        .admin-content .form-select {
            min-height: 43px;
            border-color: #dfe4ed;
            border-radius: 9px;
        }

        .admin-content .form-control:focus,
        .admin-content .form-select:focus {
            border-color: #fb7185;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.09);
        }

        .btn-cinego {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 10px 17px;
            border: 0;
            border-radius: 9px;
            background: var(--admin-accent);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-cinego:hover {
            background: #be123c;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-admin-light {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 43px;
            padding: 9px 14px;
            border: 1px solid var(--admin-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-admin-light:hover {
            background: #f8fafc;
            color: #111827;
        }

        .movie-table {
            margin: 0;
        }

        .movie-table thead th {
            padding: 16px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--admin-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .movie-table tbody td {
            padding: 14px 18px;
            border-color: #f0f2f7;
            vertical-align: middle;
            font-size: 13px;
        }

        .movie-table tbody tr:hover {
            background: #fcfcfe;
        }

        .movie-poster {
            width: 52px;
            height: 69px;
            border-radius: 8px;
            object-fit: cover;
            background: #f1f5f9;
        }

        .movie-title {
            color: #1f2937;
            font-weight: 750;
        }

        .movie-id {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 11px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .status-showing {
            background: #dcfce7;
            color: #15803d;
        }

        .status-coming {
            background: #fef3c7;
            color: #a16207;
        }

        .status-ended {
            background: #e2e8f0;
            color: #475569;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            background: #fff1f2;
            color: var(--admin-accent);
            font-size: 30px;
        }

        .admin-footer {
            padding: 24px 0 6px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 18px;
            }

            .admin-brand {
                padding-bottom: 15px;
            }

            .admin-nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .admin-nav-link {
                padding: 10px 12px;
            }

            .sidebar-heading {
                margin-top: 6px;
            }

            .sidebar-bottom {
                margin-top: 15px;
                padding-top: 12px;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                position: relative;
                padding: 18px 20px;
            }

            .admin-content {
                padding: 22px 18px;
            }
        }

        @media (max-width: 575.98px) {
            .admin-topbar {
                align-items: flex-start;
            }

            .profile-info {
                display: none;
            }

            .admin-content {
                padding: 18px 12px;
            }

            .movie-table thead th,
            .movie-table tbody td {
                padding: 12px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
<div class="admin-shell">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">

        <a href="{{ route('admin.movies.index') }}" class="admin-brand">
            <span class="brand-icon">
                <i class="bi bi-film"></i>
            </span>

            <span>
                <span class="brand-name">CineGo</span>
                <span class="brand-subtitle">ADMIN PANEL</span>
            </span>
        </a>

        <div class="sidebar-heading">Không gian quản trị</div>

        <nav class="admin-nav">

            <a href="{{ url('/') }}" class="admin-nav-link">
                <i class="bi bi-house-door"></i>
                <span>Xem website</span>
            </a>

            <a
                href="{{ route('admin.movies.index') }}"
                class="admin-nav-link {{ request()->routeIs('admin.movies.index') ? 'active' : '' }}"
            >
                <i class="bi bi-collection-play"></i>
                <span>Quản lý phim</span>
            </a>

            <a
                href="{{ route('admin.movies.create') }}"
                class="admin-nav-link {{ request()->routeIs('admin.movies.create') ? 'active' : '' }}"
            >
                <i class="bi bi-plus-circle"></i>
                <span>Thêm phim mới</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="sidebar-heading">Tài khoản</div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="admin-nav-link admin-nav-button">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Đăng xuất</span>
                </button>
            </form>

        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="admin-main">

        <header class="admin-topbar">

            <div>
                <div class="topbar-caption">CINEGO / ADMINISTRATION</div>

                <h1 class="topbar-title">
                    @yield('page_title', 'Quản trị hệ thống')
                </h1>
            </div>

            <div class="admin-profile">

                <div class="admin-avatar">
                    {{ strtoupper(substr(optional(auth()->user())->name ?? 'A', 0, 1)) }}
                </div>

                <div class="profile-info">
                    <div class="profile-name">
                        {{ optional(auth()->user())->name ?? 'Quản trị viên' }}
                    </div>

                    <div class="profile-role">Quản trị viên</div>
                </div>

            </div>

        </header>

        <main class="admin-content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3"
                     role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Đóng"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3"
                     role="alert">
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Đóng"></button>
                </div>
            @endif

            @yield('content')

            <footer class="admin-footer">
                © {{ date('Y') }} CineGo · Hệ thống quản lý rạp chiếu phim
            </footer>

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>