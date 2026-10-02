<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); // Tên phim
            $table->text('description'); // Mô tả
            $table->integer('duration_minutes'); // Thời lượng
            $table->date('release_date'); // Ngày phát hành
            $table->string('genre'); // Thể loại
            $table->string('poster')->nullable(); // Ảnh poster
            $table->string('status'); // Trạng thái: coming_soon, showing, ended
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
