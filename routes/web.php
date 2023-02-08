<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\IndexController as DashboardIndexController;
use App\Http\Controllers\Dashboard\CirculationController as DashboardCirculationController;
use App\Http\Controllers\Dashboard\MemberController as DashboardMemberController;
use App\Http\Controllers\Dashboard\BookController as DashboardBookController;

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

Route::get('/dashboard',
    [DashboardIndexController::class, 'index']
)->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Circulation Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/sirkulasi',
    [DashboardCirculationController::class, 'index']
)->middleware(['role:Admin, Petugas'])->name('sirkulasi');

Route::post('/dashboard/sirkulasi',
    [DashboardCirculationController::class, 'store']
)->middleware(['role:Admin, Petugas'])->name('sirkulasi.store');

Route::patch('/dashboard/sirkulasi/{circulation}/perpanjang',
    [DashboardCirculationController::class, 'extend']
)->middleware(['role:Admin, Petugas'])->name('sirkulasi.extend');

Route::patch('/dashboard/sirkulasi/{circulation}/kembalikan',
    [DashboardCirculationController::class, 'return']
)->middleware(['role:Admin, Petugas'])->name('sirkulasi.return');

// 404

Route::get('/dashboard/sirkulasi/{circulation}/perpanjang', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

Route::get('/dashboard/sirkulasi/{circulation}/kembalikan', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/anggota',
    [DashboardMemberController::class, 'index']
)->middleware(['role:Admin, Petugas'])->name('anggota');

Route::post('/dashboard/anggota',
    [DashboardMemberController::class, 'store']
)->middleware(['role:Admin, Petugas'])->name('anggota.store');

Route::patch('/dashboard/anggota/{member}/ubah-status',
    [DashboardMemberController::class, 'switchStatus']
)->middleware(['role:Admin, Petugas'])->name('anggota.switch');

Route::put('/dashboard/anggota/{member}/edit',
    [DashboardMemberController::class, 'update']
)->middleware(['role:Admin, Petugas'])->name('anggota.update');

Route::delete('/dashboard/anggota/{member}/hapus',
    [DashboardMemberController::class, 'destroy']
)->middleware(['role:Admin, Petugas'])->name('anggota.destroy');

// 404

Route::get('/dashboard/anggota/{member}/ubah-status', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

Route::get('/dashboard/anggota/{member}/edit', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

Route::get('/dashboard/anggota/{member}/hapus', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

/*
|--------------------------------------------------------------------------
| Book Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/buku',
    [DashboardBookController::class, 'index']
)->middleware(['role:Admin, Petugas'])->name('buku');

Route::post('/dashboard/buku',
    [DashboardBookController::class, 'store']
)->middleware(['role:Admin, Petugas'])->name('buku.store');

Route::put('/dashboard/buku/{book}/edit',
    [DashboardBookController::class, 'update']
)->middleware(['role:Admin, Petugas'])->name('buku.update');

/*
|--------------------------------------------------------------------------
| Transaction Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/transaksi', function () {
    return view('pages.dashboard.laporan.transaksi');
})->middleware(['auth'])->name('laporan.transaksi');

/*
|--------------------------------------------------------------------------
| Member Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/anggota', function () {
    return view('pages.dashboard.laporan.anggota');
})->middleware(['auth'])->name('laporan.anggota');

/*
|--------------------------------------------------------------------------
| Visitor Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/pengunjung', function () {
    return view('pages.dashboard.laporan.pengunjung');
})->middleware(['auth'])->name('laporan.pengunjung');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
