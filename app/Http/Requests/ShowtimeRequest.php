<?php

namespace App\Http\Requests;

use App\Models\Showtime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validation dùng chung cho thêm (store) và sửa (update) suất chiếu.
 */
class ShowtimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Quyền truy cập đã được chặn bởi middleware auth + admin ở routes.
        return true;
    }

    public function rules(): array
    {
        return [
            'movie_id'          => ['required', 'integer', 'exists:movies,id'],
            'show_date'         => ['required', 'date'],
            'start_time'        => ['required', 'date_format:H:i'],
            'end_time'          => ['required', 'date_format:H:i', 'after:start_time'],
            'room_name'         => ['required', 'string', 'max:100'],
            'ticket_price'      => ['required', 'numeric', 'gt:0', 'max:99999999'],
            'total_tickets'     => ['required', 'integer', 'gt:0'],
            // Có thể để trống khi thêm mới -> controller tự gán = total_tickets
            'available_tickets' => ['nullable', 'integer', 'min:0', 'lte:total_tickets'],
            'status'            => ['required', Rule::in(array_keys(Showtime::STATUSES))],
        ];
    }

    public function messages(): array
    {
        return [
            'movie_id.required'          => 'Vui lòng chọn phim.',
            'movie_id.exists'            => 'Phim được chọn không tồn tại.',
            'show_date.required'         => 'Vui lòng nhập ngày chiếu.',
            'show_date.date'             => 'Ngày chiếu không hợp lệ.',
            'start_time.required'        => 'Vui lòng nhập giờ bắt đầu.',
            'start_time.date_format'     => 'Giờ bắt đầu phải có dạng HH:MM.',
            'end_time.required'          => 'Vui lòng nhập giờ kết thúc.',
            'end_time.date_format'       => 'Giờ kết thúc phải có dạng HH:MM.',
            'end_time.after'             => 'Giờ kết thúc phải sau giờ bắt đầu.',
            'room_name.required'         => 'Vui lòng nhập tên phòng chiếu.',
            'room_name.max'              => 'Tên phòng không được vượt quá 100 ký tự.',
            'ticket_price.required'      => 'Vui lòng nhập giá vé.',
            'ticket_price.numeric'       => 'Giá vé phải là số.',
            'ticket_price.gt'            => 'Giá vé phải lớn hơn 0.',
            'total_tickets.required'     => 'Vui lòng nhập tổng số vé.',
            'total_tickets.integer'      => 'Tổng số vé phải là số nguyên.',
            'total_tickets.gt'           => 'Tổng số vé phải lớn hơn 0.',
            'available_tickets.integer'  => 'Số vé còn lại phải là số nguyên.',
            'available_tickets.min'      => 'Số vé còn lại không được âm.',
            'available_tickets.lte'      => 'Số vé còn lại không được lớn hơn tổng số vé.',
            'status.required'            => 'Vui lòng chọn trạng thái.',
            'status.in'                  => 'Trạng thái không hợp lệ.',
        ];
    }
}
