@extends('layouts.admin')

@section('title', 'Thêm phim mới | CineGo')
@section('page_title', 'Thêm phim mới')

@section('content')

    <!-- TIÊU ĐỀ -->
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <div class="page-label">Thư viện phim</div>

            <h2 class="page-heading">Thêm phim mới</h2>

            <p class="page-description">
                Điền thông tin để đưa phim vào hệ thống CineGo.
            </p>
        </div>

        <a href="{{ route('admin.movies.index') }}"
           class="btn-admin-light">

            <i class="bi bi-arrow-left"></i>
            Quay lại danh sách

        </a>

    </div>


    <!-- FORM THÊM PHIM -->
    <div class="admin-card overflow-hidden">

        <div class="p-3 p-md-4 border-bottom">

            <h5 class="fw-bold mb-1">
                <i class="bi bi-camera-reels me-2"
                   style="color:#e11d48;"></i>
                Thông tin phim
            </h5>

            <p class="text-secondary small mb-0">
                Những trường có dấu
                <span class="text-danger">*</span>
                là bắt buộc.
            </p>

        </div>


        <form action="{{ route('admin.movies.store') }}"
              method="POST">

            @csrf

            <div class="p-3 p-md-4">

                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <strong>Vui lòng kiểm tra lại thông tin.</strong>

                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <!-- TÊN PHIM -->
                <div class="mb-4">

                    <label for="title" class="form-label fw-bold">
                        Tên phim <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="Ví dụ: Đào, Phở và Piano"
                        required
                    >

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>


                <!-- THỂ LOẠI VÀ THỜI LƯỢNG -->
                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6">

                        <label for="genre" class="form-label fw-bold">
                            Thể loại <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="genre"
                            name="genre"
                            class="form-control @error('genre') is-invalid @enderror"
                            value="{{ old('genre') }}"
                            placeholder="Hành động, Tình cảm..."
                            required
                        >

                        @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="col-12 col-md-6">

                        <label for="duration_minutes"
                               class="form-label fw-bold">

                            Thời lượng (phút)
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="number"
                            id="duration_minutes"
                            name="duration_minutes"
                            class="form-control @error('duration_minutes') is-invalid @enderror"
                            value="{{ old('duration_minutes') }}"
                            placeholder="120"
                            min="1"
                            required
                        >

                        @error('duration_minutes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>


                <!-- NGÀY PHÁT HÀNH VÀ TRẠNG THÁI -->
                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6">

                        <label for="release_date"
                               class="form-label fw-bold">

                            Ngày phát hành
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            id="release_date"
                            name="release_date"
                            class="form-control @error('release_date') is-invalid @enderror"
                            value="{{ old('release_date') }}"
                            required
                        >

                        @error('release_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="col-12 col-md-6">

                        <label for="status" class="form-label fw-bold">
                            Trạng thái <span class="text-danger">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >

                            <option value="showing"
                                {{ old('status', 'showing') == 'showing' ? 'selected' : '' }}>
                                Đang chiếu
                            </option>

                            <option value="coming_soon"
                                {{ old('status') == 'coming_soon' ? 'selected' : '' }}>
                                Sắp chiếu
                            </option>

                            <option value="ended"
                                {{ old('status') == 'ended' ? 'selected' : '' }}>
                                Đã kết thúc
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>


                <!-- POSTER -->
                <div class="mb-4">

                    <label for="poster" class="form-label fw-bold">
                        Đường dẫn ảnh poster
                    </label>

                    <input
                        type="text"
                        id="poster"
                        name="poster"
                        class="form-control @error('poster') is-invalid @enderror"
                        value="{{ old('poster') }}"
                        placeholder="https://example.com/poster.jpg"
                    >

                    <div class="form-text">
                        Nhập URL ảnh poster. Để trống nếu chưa có ảnh.
                    </div>

                    @error('poster')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>


                <!-- MÔ TẢ -->
                <div class="mb-4">

                    <label for="description" class="form-label fw-bold">
                        Nội dung phim <span class="text-danger">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Nhập tóm tắt nội dung phim..."
                        required
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>


                <!-- NÚT LƯU -->
                <div class="d-flex flex-wrap justify-content-end
                            gap-2 pt-3 border-top">

                    <a href="{{ route('admin.movies.index') }}"
                       class="btn-admin-light">

                        Hủy bỏ

                    </a>

                    <button type="submit" class="btn-cinego">

                        <i class="bi bi-check-lg"></i>
                        Lưu phim

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection