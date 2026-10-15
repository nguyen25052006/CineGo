<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * 1. Hiển thị danh sách phim kèm tính năng Tìm Kiếm (Phần của Vy & Hữu Thịnh)
     */
    
    /*
    |--------------------------------------------------------------------------
    | Trang chủ
    |--------------------------------------------------------------------------
    */

    public function home()
    {
        // Lấy tối đa 4 phim đang chiếu từ database.
        $movies = Movie::where('status', 'showing')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('movies'));
    }


    /*
    |--------------------------------------------------------------------------
    | Danh sách phim công khai
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request)
    {
        // Khởi tạo truy vấn danh sách phim.
        $query = Movie::query()
            ->whereIn('status', ['showing', 'coming_soon']);

        // Tìm phim theo tên.
        if ($request->filled('search')) {
            $query->where(
                'title',
                'like',
                '%' . $request->input('search') . '%'
            );
        }

        // Lọc phim theo thể loại.
        if ($request->filled('genre')) {
            $query->where(
                'genre',
                'like',
                '%' . $request->input('genre') . '%'
            );
        }

        // Mỗi trang tối đa 12 phim.
        $movies = $query->latest()
            ->paginate(12)
            ->withQueryString();

        return view('movies.index', compact('movies'));
    }


    /*
    |--------------------------------------------------------------------------
    | Chi tiết phim và danh sách suất chiếu
    |--------------------------------------------------------------------------
    */

    public function show(Movie $movie)
    {
        // Lấy các suất chiếu đang hoạt động của đúng bộ phim.
        $showtimes = $movie->showtimes()
            ->where('status', 'active')
            ->whereDate('show_date', '>=', today())
            ->orderBy('show_date')
            ->orderBy('start_time')
            ->get();

        return view('movies.show', compact('movie', 'showtimes'));
    }


    public function index(Request $request)
    {
        // Nhận dữ liệu từ ô tìm kiếm tên phim
        $search = $request->input('search');

        // Nếu có tìm kiếm thì lọc theo tên phim, ngược lại lấy toàn bộ và phân trang 10 bộ phim/trang
        $movies = Movie::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        // Trả về giao diện danh sách chính xác theo thư mục của bạn
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * 2. Hiển thị Form tạo/thêm phim mới
     */
    public function create()
    {
        // Trả về giao diện form thêm phim mới
        return view('admin.movies.create');
    }

    /**
     * 3. Xử lý logic và lưu dữ liệu phim mới vào Database (Cơ sở dữ liệu)
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào (Validation) chuẩn xác theo các trường trong DB nhóm thống nhất
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'poster' => 'nullable|string|max:255',
            'status' => 'required|string|in:coming_soon,showing,ended',
        ], [
            // Thông báo trả lỗi tùy biến bằng tiếng Việt trực quan
            'title.required' => 'Vui lòng nhập tên phim.',
            'description.required' => 'Vui lòng nhập nội dung mô tả bộ phim.',
            'duration_minutes.required' => 'Vui lòng nhập thời lượng phim.',
            'duration_minutes.integer' => 'Thời lượng phim bắt buộc phải là số nguyên.',
            'duration_minutes.min' => 'Thời lượng phim phải hợp lệ (lớn hơn 0).',
            'release_date.required' => 'Vui lòng chọn ngày phát hành phim.',
            'genre.required' => 'Vui lòng nhập thể loại phim.',
            'status.required' => 'Vui lòng chọn trạng thái hiển thị của phim.',
            'status.in' => 'Trạng thái phim không hợp lệ.',
        ]);

        // Tạo bản ghi dữ liệu mới tự động thông qua Model Movie
        Movie::create($validated);

        // Lưu thành công, điều hướng quay lại trang danh sách kèm thông báo alert
        return redirect()->route('admin.movies.index')->with('success', 'Thêm phim mới thành công!');
    }
}
