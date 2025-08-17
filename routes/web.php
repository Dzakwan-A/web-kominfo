<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::resource('posts', PostController::class);
     });

Route::middleware(['auth'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         // Resource route untuk EventController:
         // - GET    /admin/events           → index
         // - GET    /admin/events/create    → create
         // - POST   /admin/events           → store
         // - GET    /admin/events/{event}   → show
         // - GET    /admin/events/{event}/edit → edit
         // - PUT    /admin/events/{event}   → update
         // - DELETE /admin/events/{event}   → destroy
         Route::resource('events', EventController::class);
     });

require __DIR__.'/auth.php';


// Admin - Galleries
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
Route::prefix('admin')->name('admin.')->group(function () {
    // Tambahkan middleware('auth') di group ini jika diperlukan:
    // ->middleware(['auth']);
    Route::resource('galleries', AdminGalleryController::class);
});
