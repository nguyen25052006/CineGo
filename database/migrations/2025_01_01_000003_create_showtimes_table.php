<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tạo bảng showtimes (suất chiếu).
     * LƯU Ý: migration này phải chạy SAU migration tạo bảng movies
     * (đặt tên file có timestamp lớn hơn migration movies).
     */
    public function up(): void
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();                                   // id (bigint, khóa chính)

            // Khóa ngoại: mỗi suất chiếu thuộc về đúng 1 phim.
            // Xóa phim -> các suất chiếu của phim đó bị xóa theo.
            $table->foreignId('movie_id')
                  ->constrained('movies')
                  ->cascadeOnDelete();

            $table->date('show_date');                      // Ngày chiếu
            $table->time('start_time');                     // Giờ bắt đầu
            $table->time('end_time');                       // Giờ kết thúc
            $table->string('room_name');                    // Tên/mã phòng chiếu
            $table->decimal('ticket_price', 10, 2);         // Giá một vé
            $table->integer('total_tickets');               // Tổng số vé
            $table->integer('available_tickets');           // Số vé còn lại
            $table->string('status')->default('active');    // active | inactive

            $table->timestamps();                           // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
