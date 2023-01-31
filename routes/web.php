<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.main.index');
})->name('main');

Route::get('/pengunjung', function () {
    return view('pages.main.pengunjung');
})->name('pengunjung');

Route::get('/tentang', function () {
    return view('pages.main.tentang');
})->name('tentang');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/sirkulasi', function () {
    return view('pages.dashboard.sirkulasi');
})->middleware(['auth'])->name('sirkulasi');

Route::get('/dashboard/anggota', function () {
    return view('pages.dashboard.anggota');
})->middleware(['auth'])->name('anggota');

Route::get('/dashboard/buku', function () {
    return view('pages.dashboard.buku');
})->middleware(['auth'])->name('buku');

Route::get('/dashboard/laporan/transaksi', function () {
    return view('pages.dashboard.laporan.transaksi');
})->middleware(['auth'])->name('laporan.transaksi');

Route::get('/dashboard/laporan/anggota', function () {
    return view('pages.dashboard.laporan.anggota');
})->middleware(['auth'])->name('laporan.anggota');

Route::get('/dashboard/laporan/pengunjung', function () {
    return view('pages.dashboard.laporan.pengunjung');
})->middleware(['auth'])->name('laporan.pengunjung');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
