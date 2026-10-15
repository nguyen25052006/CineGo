<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowtimeRequest;
use App\Models\Movie;
use App\Models\Showtime;

class ShowtimeController extends Controller
{
    /** UC20 - Danh sách suất chiếu (có phân trang). GET /admin/showtimes */
    public function index()
    {
        $showtimes = Showtime::with('movie')          // eager loading: tránh lỗi N+1 query
            ->orderByDesc('show_date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('admin.showtimes.index', compact('showtimes'));
    }

    /** UC21 - Form thêm suất chiếu. GET /admin/showtimes/create */
    public function create()
    {
        $movies = Movie::orderBy('title')->get(['id', 'title']);

        return view('admin.showtimes.create', compact('movies'));
    }

    /** UC21 - Lưu suất chiếu mới. POST /admin/showtimes */
    public function store(ShowtimeRequest $request)
    {
        $data = $request->validated();

        // Nếu không nhập "số vé còn" thì mặc định = tổng số vé (chưa bán vé nào)
        if (!isset($data['available_tickets'])) {
            $data['available_tickets'] = $data['total_tickets'];
        }

        Showtime::create($data);

        return redirect()
            ->route('admin.showtimes.index')
            ->with('success', 'Thêm suất chiếu thành công.');
    }

    /** UC22 - Xem chi tiết suất chiếu. GET /admin/showtimes/{showtime} */
    public function show(Showtime $showtime)
    {
        $showtime->load('movie');

        return view('admin.showtimes.show', compact('showtime'));
    }

    /** UC23 - Form sửa suất chiếu. GET /admin/showtimes/{showtime}/edit */
    public function edit(Showtime $showtime)
    {
        $movies = Movie::orderBy('title')->get(['id', 'title']);

        return view('admin.showtimes.edit', compact('showtime', 'movies'));
    }

    /** UC23 - Cập nhật suất chiếu. PUT/PATCH /admin/showtimes/{showtime} */
    public function update(ShowtimeRequest $request, Showtime $showtime)
    {
        $data = $request->validated();

        // Nếu bỏ trống "số vé còn" thì giữ nguyên giá trị cũ
        if (!isset($data['available_tickets'])) {
            $data['available_tickets'] = $showtime->available_tickets;
        }

        // Không cho "số vé còn" vượt quá tổng vé mới
        if ($data['available_tickets'] > $data['total_tickets']) {
            return back()
                ->withInput()
                ->withErrors(['available_tickets' => 'Số vé còn lại không được lớn hơn tổng số vé.']);
        }

        $showtime->update($data);

        return redirect()
            ->route('admin.showtimes.index')
            ->with('success', 'Cập nhật suất chiếu thành công.');
    }

    /** UC24 - Xóa suất chiếu. DELETE /admin/showtimes/{showtime} */
    public function destroy(Showtime $showtime)
    {
        // Suất chiếu đã có người đặt vé thì không được xóa (bảo toàn lịch sử đặt vé).
        // Gợi ý: chuyển sang trạng thái inactive thay vì xóa.
        if ($showtime->bookingDetails()->exists()) {
            return redirect()
                ->route('admin.showtimes.index')
                ->with('error', 'Không thể xóa suất chiếu đã có người đặt vé. Hãy chuyển sang trạng thái "Ngừng hoạt động".');
        }

        $showtime->delete();

        return redirect()
            ->route('admin.showtimes.index')
            ->with('success', 'Xóa suất chiếu thành công.');
    }
}
