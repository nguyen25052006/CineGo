@extends('layouts.app')

@section('title', 'Đăng nhập - CineGo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card card-custom shadow-lg">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle fs-1 text-danger"></i>

                        <h2 class="fw-bold mt-3 mb-2">
                            Đăng nhập
                        </h2>

                        <p class="text-secondary mb-0">
                            Đăng nhập để đặt vé xem phim cùng CineGo
                        </p>
                    </div>

                    {{-- Hiển thị lỗi validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Nhập email"
                                autocomplete="email"
                                required
                                autofocus
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                Mật khẩu
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu"
                                autocomplete="current-password"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="btn btn-cinego w-100 py-2 fw-semibold"
                        >
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Đăng nhập
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-secondary">
                            Chưa có tài khoản?
                        </span>

                        <a
                            href="{{ route('register') }}"
                            class="text-warning text-decoration-none fw-semibold"
                        >
                            Đăng ký ngay
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection