<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')
                  ->nullable()                 // atau ->constrained()->cascadeOnDelete() jika wajib
                  ->after('slug')
                  ->constrained('categories');
        });
    }

    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};

