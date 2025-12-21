<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            if (!Schema::hasColumn('posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('slug');
            }

            if (!Schema::hasColumn('posts', 'user_id')) {
                $table->foreignId('user_id')->nullable()
                      ->constrained()
                      ->nullOnDelete()
                      ->after('published_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            if (Schema::hasColumn('posts', 'excerpt')) {
                $table->dropColumn('excerpt');
            }
        });
    }
};

