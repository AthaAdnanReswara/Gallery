<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\GalleryController;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

//photo
Route::get('/', [GalleryController::class, 'index'])->name('public.index');
Route::get('/album/{slug}', [GalleryController::class, 'show'])->name('album.show');
//public tambah photo dengan status pandding
Route::post('/photo/upload', [GalleryController::class, 'store'])->name('photo.upload.public');
//about
Route::get('/about', [GalleryController::class, 'about'])->name('public.about');

//Fungsi Login dan Logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Dashboard Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'login'])->name('dashboard');
    //crud album
    Route::resource('album', AlbumController::class);
    //crud photo
    Route::resource('photo', PhotoController::class);
    //
    Route::get('photo-pending', [PhotoController::class, 'pending'])
        ->name('photo.pending');

    Route::get('/photo/{photo}', [PhotoController::class, 'show'])
        ->name('photo.show');

    Route::post('/photo/{photo}/approve', [PhotoController::class, 'approve'])
        ->name('photo.approve');

    Route::post('/photo/{photo}/reject', [PhotoController::class, 'reject'])
        ->name('photo.reject');
});
