<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('posts', 'views')) {
            Schema::table('posts', function (Blueprint $table) {
                // Pakai bigint agar aman untuk hitungan besar (cocok untuk PostgreSQL maupun MySQL)
                $table->unsignedBigInteger('views')->default(0);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('posts', 'views')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('views');
            });
        }
    }
};
