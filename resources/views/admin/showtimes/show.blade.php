@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Chi tiết suất chiếu #{{ $showtime->id }}</h3>

    <table class="table table-bordered w-75">
        <tr><th style="width:220px">Phim</th><td>{{ $showtime->movie->title ?? '(Phim đã bị xóa)' }}</td></tr>
        <tr><th>Ngày chiếu</th><td>{{ $showtime->show_date->format('d/m/Y') }}</td></tr>
        <tr><th>Giờ bắt đầu</th><td>{{ $showtime->start_time_short }}</td></tr>
        <tr><th>Giờ kết thúc</th><td>{{ $showtime->end_time_short }}</td></tr>
        <tr><th>Phòng chiếu</th><td>{{ $showtime->room_name }}</td></tr>
        <tr><th>Giá vé</th><td>{{ $showtime->formatted_price }}</td></tr>
        <tr><th>Tổng số vé</th><td>{{ $showtime->total_tickets }}</td></tr>
        <tr><th>Số vé còn</th><td>{{ $showtime->available_tickets }}</td></tr>
        <tr><th>Trạng thái</th><td>{{ \App\Models\Showtime::STATUSES[$showtime->status] ?? $showtime->status }}</td></tr>
        <tr><th>Ngày tạo</th><td>{{ $showtime->created_at->format('d/m/Y H:i') }}</td></tr>
        <tr><th>Cập nhật lần cuối</th><td>{{ $showtime->updated_at->format('d/m/Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('admin.showtimes.edit', $showtime) }}" class="btn btn-warning">Sửa</a>
    <a href="{{ route('admin.showtimes.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
