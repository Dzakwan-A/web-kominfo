<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('title'); // judul berita
            $table->string('slug')->unique(); // slug untuk URL
            $table->text('body'); // isi konten berita
            $table->string('thumbnail')->nullable(); // gambar utama
            $table->timestamp('published_at')->nullable(); // tanggal terbit
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('posts');
    }
};
