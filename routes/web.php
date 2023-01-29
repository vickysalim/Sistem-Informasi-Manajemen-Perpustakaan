<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/sirkulasi', function () {
    return view('pages.dashboard.sirkulasi');
})->middleware(['auth'])->name('sirkulasi');

Route::get('/anggota', function () {
    return view('pages.dashboard.anggota');
})->middleware(['auth'])->name('anggota');

Route::get('/buku', function () {
    return view('pages.dashboard.buku');
})->middleware(['auth'])->name('buku');

Route::get('/laporan/transaksi', function () {
    return view('pages.dashboard.laporan.transaksi');
})->middleware(['auth'])->name('laporan.transaksi');

Route::get('/laporan/anggota', function () {
    return view('pages.dashboard.laporan.anggota');
})->middleware(['auth'])->name('laporan.anggota');

Route::get('/laporan/pengunjung', function () {
    return view('pages.dashboard.laporan.pengunjung');
})->middleware(['auth'])->name('laporan.pengunjung');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
