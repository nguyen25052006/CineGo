@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Quản lý suất chiếu</h3>
        <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary">+ Thêm suất chiếu</a>
    </div>

    {{-- Thông báo (xóa 2 khối này nếu layout chung đã hiển thị thông báo) --}}
    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Phim</th>
                    <th>Ngày</th>
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th>Phòng</th>
                    <th>Giá vé</th>
                    <th>Số vé còn</th>
                    <th>Trạng thái</th>
                    <th style="width:190px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($showtimes as $showtime)
                    <tr>
                        <td>{{ $showtimes->firstItem() + $loop->index }}</td>
                        <td>{{ $showtime->movie->title ?? '(Phim đã bị xóa)' }}</td>
                        <td>{{ $showtime->show_date->format('d/m/Y') }}</td>
                        <td>{{ $showtime->start_time_short }}</td>
                        <td>{{ $showtime->end_time_short }}</td>
                        <td>{{ $showtime->room_name }}</td>
                        <td>{{ $showtime->formatted_price }}</td>
                        <td>{{ $showtime->available_tickets }} / {{ $showtime->total_tickets }}</td>
                        <td>
                            @if ($showtime->status === 'active')
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Ngừng</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.showtimes.show', $showtime) }}" class="btn btn-sm btn-info">Xem</a>
                            <a href="{{ route('admin.showtimes.edit', $showtime) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.showtimes.destroy', $showtime) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa suất chiếu này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center text-muted">Chưa có suất chiếu nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $showtimes->links() }}
</div>
@endsection
