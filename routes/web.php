<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

require __DIR__.'/auth.php';
