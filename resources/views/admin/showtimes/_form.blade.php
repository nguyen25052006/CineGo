{{-- Form dùng chung cho thêm / sửa suất chiếu. Biến: $movies, $showtime (null khi thêm) --}}
@php $st = $showtime ?? null; @endphp

<div class="mb-3">
    <label for="movie_id" class="form-label">Phim <span class="text-danger">*</span></label>
    <select name="movie_id" id="movie_id" class="form-select @error('movie_id') is-invalid @enderror">
        <option value="">-- Chọn phim --</option>
        @foreach ($movies as $movie)
            <option value="{{ $movie->id }}"
                {{ old('movie_id', $st?->movie_id) == $movie->id ? 'selected' : '' }}>
                {{ $movie->title }}
            </option>
        @endforeach
    </select>
    @error('movie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="show_date" class="form-label">Ngày chiếu <span class="text-danger">*</span></label>
        <input type="date" name="show_date" id="show_date"
               class="form-control @error('show_date') is-invalid @enderror"
               value="{{ old('show_date', $st?->show_date?->format('Y-m-d')) }}">
        @error('show_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="start_time" class="form-label">Giờ bắt đầu <span class="text-danger">*</span></label>
        <input type="time" name="start_time" id="start_time"
               class="form-control @error('start_time') is-invalid @enderror"
               value="{{ old('start_time', $st?->start_time_short) }}">
        @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="end_time" class="form-label">Giờ kết thúc <span class="text-danger">*</span></label>
        <input type="time" name="end_time" id="end_time"
               class="form-control @error('end_time') is-invalid @enderror"
               value="{{ old('end_time', $st?->end_time_short) }}">
        @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="room_name" class="form-label">Phòng chiếu <span class="text-danger">*</span></label>
        <input type="text" name="room_name" id="room_name" maxlength="100"
               class="form-control @error('room_name') is-invalid @enderror"
               value="{{ old('room_name', $st?->room_name) }}" placeholder="VD: Phòng 1">
        @error('room_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="ticket_price" class="form-label">Giá vé (đ) <span class="text-danger">*</span></label>
        <input type="number" step="1000" min="0" name="ticket_price" id="ticket_price"
               class="form-control @error('ticket_price') is-invalid @enderror"
               value="{{ old('ticket_price', $st?->ticket_price) }}" placeholder="VD: 80000">
        @error('ticket_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="total_tickets" class="form-label">Tổng số vé <span class="text-danger">*</span></label>
        <input type="number" min="1" name="total_tickets" id="total_tickets"
               class="form-control @error('total_tickets') is-invalid @enderror"
               value="{{ old('total_tickets', $st?->total_tickets) }}">
        @error('total_tickets') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="available_tickets" class="form-label">Số vé còn</label>
        <input type="number" min="0" name="available_tickets" id="available_tickets"
               class="form-control @error('available_tickets') is-invalid @enderror"
               value="{{ old('available_tickets', $st?->available_tickets) }}">
        <div class="form-text">Để trống khi thêm mới: hệ thống tự lấy bằng tổng số vé.</div>
        @error('available_tickets') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
            @foreach (\App\Models\Showtime::STATUSES as $value => $label)
                <option value="{{ $value }}"
                    {{ old('status', $st?->status ?? 'active') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<button type="submit" class="btn btn-primary">Lưu</button>
<a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary">Hủy</a>
