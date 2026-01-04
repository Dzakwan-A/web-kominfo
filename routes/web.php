<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Writer\PostController as WriterPostController;
use App\Http\Controllers\PublicPostController;

// AREA ADMIN (controller yang dipakai)
use App\Http\Controllers\Admin\PostController as AdminPostControllerResource;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\AdminPostController; // controller custom untuk dashboard admin

/* =========================
|  PUBLIC / FRONT SITE
|========================= */

// Beranda (Blade)
Route::get('/', fn () => view('home'))->name('home');

// Dashboard user (Blade) – hanya setelah login & verified
Route::middleware(['auth','verified'])
    ->get('/dashboard', fn () => view('dashboard'))
    ->name('dashboard');

Route::get('/berita', [PublicPostController::class, 'index'])->name('posts.index');
// Hasil pencarian / filter berita (judul + tag)
Route::get('/berita/result/filter', [PublicPostController::class, 'filter'])->name('posts.filter');
Route::get('/berita/{post:slug}', [PublicPostController::class, 'show'])->name('posts.show');
Route::get('/profil/standar-pelayanan', [ProfileController::class, 'standarpelayanan'])
  ->name('profil.standar');

Route::view('/profil/tentang', 'profil.tentang')->name('profil.tentang');
Route::view('/profil/visi-misi', 'profil.visi')->name('profil.visi');
Route::view('/profil/struktur-organisasi', 'profil.struktur')->name('profil.struktur');
Route::view('/profil/tupoksi', 'profil.tupoksi')->name('profil.tupoksi');
Route::view('/profil/data-pegawai', 'profil.pegawai')->name('profil.pegawai');
Route::view('/profil/lhkpn', 'profil.lhkpn')->name('profil.lhkpn');
Route::view('/faq', 'faq')->name('faq');


/* =========================
|  PROFILE (USER)
|========================= */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* =========================
|  ADMIN AREA (HANYA ADMIN)
|========================= */
Route::middleware(['auth','can:isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin kustom
        Route::get('/', [AdminPostController::class, 'dashboard'])->name('dashboard');

        // CRUD konten admin
        Route::resource('posts', AdminPostControllerResource::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('galleries', AdminGalleryController::class);
    });


    Route::middleware(['auth', 'verified', 'can:isWriter'])
    ->prefix('penulis')
    ->name('writer.')
    ->group(function () {

        // Dashboard Penulis
        Route::get('/', [WriterPostController::class, 'dashboard'])->name('dashboard');

        // Penulis hanya boleh: buat & simpan berita (dan lihat listnya)
        Route::get('/posts/create', [WriterPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [WriterPostController::class, 'store'])->name('posts.store');

        
        Route::get('/posts/{post}/edit', [WriterPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [WriterPostController::class, 'update'])->name('posts.update');

        Route::get('/posts/{post}/edit', [WriterPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [WriterPostController::class, 'update'])->name('posts.update');

        Route::delete('/posts/{post}', [WriterPostController::class, 'destroy'])->name('posts.destroy');


    });


require __DIR__.'/auth.php';
