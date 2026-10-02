<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phim Mới - CineGo</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
    <link href="https://cloudflare.com" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5" style="max-width: 800px;">
        <div class="card shadow-sm border-0">
            <!-- Tiêu đề form -->
            <div class="card-header bg-dark text-white py-3">
                <h4 class="mb-0 fw-bold"><i class="fa-solid fa-circle-plus me-2"></i>THÊM PHIM MỚI</h4>
            </div>
            
            <div class="card-body p-4 bg-white rounded-bottom">
                <!-- Form gửi dữ liệu đến Route admin.movies.store -->
                <form action="{{ route('admin.movies.store') }}" method="POST">
                    @csrf

                    <!-- 1. Tên phim -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Tên phim <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Nhập tên bộ phim...">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 2. Thể loại & Thời lượng -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="genre" class="form-label fw-bold">Thể loại <span class="text-danger">*</span></label>
                            <input type="text" name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre') }}" placeholder="Ví dụ: Hành động, Tình cảm...">
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="duration_minutes" class="form-label fw-bold">Thời lượng (phút) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_minutes" id="duration_minutes" class="form-control @error('duration_minutes') is-invalid @enderror" value="{{ old('duration_minutes') }}" placeholder="Ví dụ: 120">
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- 3. Ngày phát hành & Trạng thái -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="release_date" class="form-label fw-bold">Ngày phát hành <span class="text-danger">*</span></label>
                            <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date') }}">
                            @error('release_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="showing" {{ old('status') == 'showing' ? 'selected' : '' }}>Đang chiếu (showing)</option>
                                <option value="coming_soon" {{ old('status') == 'coming_soon' ? 'selected' : '' }}>Sắp chiếu (coming_soon)</option>
                                <option value="ended" {{ old('status') == 'ended' ? 'selected' : '' }}>Đã kết thúc (ended)</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- 4. Đường dẫn Poster -->
                    <div class="mb-3">
                        <label for="poster" class="form-label fw-bold">Đường dẫn ảnh Poster (URL)</label>
                        <input type="text" name="poster" id="poster" class="form-control @error('poster') is-invalid @enderror" value="{{ old('poster') }}" placeholder="https://example.com">
                        @error('poster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 5. Nội dung / Mô tả phim -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Nội dung / Mô tả phim <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Nhập tóm tắt nội dung phim...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Khối nút bấm (Lưu / Hủy chốt theo bản thiết kế) -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary px-4 fw-semibold">Hủy</a>
                        <button type="submit" class="btn btn-success px-4 fw-semibold">Lưu Phim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
