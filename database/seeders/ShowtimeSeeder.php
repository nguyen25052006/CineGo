<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Database\Seeder;

/**
 * Dữ liệu mẫu để test: mỗi phim có 3 suất chiếu.
 * Chạy: php artisan db:seed --class=ShowtimeSeeder   (sau khi đã có dữ liệu movies)
 */
class ShowtimeSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            ['09:00', '11:00', 'Phòng 1', 70000],
            ['14:00', '16:00', 'Phòng 2', 80000],
            ['19:30', '21:30', 'Phòng 3', 90000],
        ];

        foreach (Movie::all() as $movie) {
            foreach ($slots as $i => [$start, $end, $room, $price]) {
                Showtime::create([
                    'movie_id'          => $movie->id,
                    'show_date'         => now()->addDays($i + 1)->toDateString(),
                    'start_time'        => $start,
                    'end_time'          => $end,
                    'room_name'         => $room,
                    'ticket_price'      => $price,
                    'total_tickets'     => 50,
                    'available_tickets' => 50,
                    'status'            => 'active',
                ]);
            }
        }
    }
}
