@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Sửa suất chiếu #{{ $showtime->id }}</h3>

    <form action="{{ route('admin.showtimes.update', $showtime) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.showtimes._form')
    </form>
</div>
@endsection
