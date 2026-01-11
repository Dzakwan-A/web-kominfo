<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();   // slug: tentang, visi-misi, dll
            $table->string('title');           // judul yang tampil di halaman
            $table->longText('content')->nullable(); // isi HTML / teks
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        // seed awal untuk semua menu profil
        DB::table('profile_pages')->insert([
            ['key' => 'tentang', 'title' => 'Tentang', 'order' => 1],
            ['key' => 'visi-misi', 'title' => 'Visi Misi', 'order' => 2],
            ['key' => 'struktur-organisasi', 'title' => 'Struktur Organisasi', 'order' => 3],
            ['key' => 'tupoksi', 'title' => 'Tupoksi Diskominfo Kota Madiun', 'order' => 4],
            ['key' => 'standar-pelayanan', 'title' => 'Standar Pelayanan', 'order' => 5],
            ['key' => 'data-pegawai', 'title' => 'Data Pegawai', 'order' => 6],
            ['key' => 'lhkpn', 'title' => 'LHKPN Pejabat Publik Pemerintah Kota Madiun', 'order' => 7],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_pages');
    }
};
