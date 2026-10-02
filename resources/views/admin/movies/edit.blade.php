@extends('layouts.admin')

@section('title', 'Chỉnh sửa phim')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="mb-4 text-warning">Chỉnh sửa phim: {{ $movie->title }}</h3>
    
    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Bắt buộc khai báo Method Spoofing gửi yêu cầu cập nhật lên tài nguyên RESTful --}}
        
        <div class="mb-3">
            <label class="form-label font-weight-bold">Tên phim</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $movie->title) }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label font-weight-bold">Mô tả phim</label>
            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $movie->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Thời lượng (phút)</label>
                <input type="number" name="duration_minutes" class="form-control @error('duration_minutes') is-invalid @enderror" value="{{ old('duration_minutes', $movie->duration_minutes) }}">
                @error('duration_minutes') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Ngày phát hành</label>
                <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date', $movie->release_date) }}">
                @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Thể loại</label>
                <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre', $movie->genre) }}">
                @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Trạng thái phim</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="showing" {{ old('status', $movie->status) == 'showing' ? 'selected' : '' }}>Đang chiếu (showing)</option>
                    <option value="coming_soon" {{ old('status', $movie->status) == 'coming_soon' ? 'selected' : '' }}>Sắp chiếu (coming_soon)</option>
                    <option value="ended" {{ old('status', $movie->status) == 'ended' ? 'selected' : '' }}>Đã kết thúc (ended)</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label font-weight-bold">Hình ảnh Poster hiện tại</label><br>
            @if($movie->poster)
                <img src="{{ asset('storage/' . $movie->poster) }}" width="120" class="img-thumbnail mb-2 d-block" alt="poster">
            @endif
            <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror">
            <small class="text-muted">Để trống nếu muốn giữ nguyên poster cũ.</small>
            @error('poster') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success px-4">Cập nhật</button>
            <a href="{{ route('admin.movies.index') }}" class="btn btn-light border px-4">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection
