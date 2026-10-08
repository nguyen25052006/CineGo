@extends('layouts.app')

@section('title', 'Đăng ký - CineGo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card card-custom shadow-lg">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus-fill fs-1 text-danger"></i>

                        <h2 class="fw-bold mt-3 mb-2">
                            Tạo tài khoản
                        </h2>

                        <p class="text-secondary mb-0">
                            Đăng ký tài khoản CineGo để bắt đầu đặt vé
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

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        {{-- Họ tên --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Họ và tên
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nhập họ và tên"
                                autocomplete="name"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

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
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Mật khẩu
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Tối thiểu 8 ký tự"
                                autocomplete="new-password"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Confirm password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                Xác nhận mật khẩu
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Nhập lại mật khẩu"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <button
                            type="submit"
                            class="btn btn-cinego w-100 py-2 fw-semibold"
                        >
                            <i class="bi bi-person-plus me-1"></i>
                            Đăng ký
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-secondary">
                            Đã có tài khoản?
                        </span>

                        <a
                            href="{{ route('login') }}"
                            class="text-warning text-decoration-none fw-semibold"
                        >
                            Đăng nhập
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection