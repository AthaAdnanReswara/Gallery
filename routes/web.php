<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/album/{slug}', [GalleryController::class, 'show'])->name('album.show');




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
});