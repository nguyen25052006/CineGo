@extends('layouts.admin') {{-- tên layout do Anh Thư tạo; đổi lại nếu khác --}}

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Thêm suất chiếu</h3>

    <form action="{{ route('admin.showtimes.store') }}" method="POST">
        @csrf
        @include('admin.showtimes._form', ['showtime' => null])
    </form>
</div>
@endsection
