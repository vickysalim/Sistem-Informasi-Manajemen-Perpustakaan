<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\IndexController as IndexController;
use App\Http\Controllers\Main\VisitorController as VisitorController;

use App\Http\Controllers\Dashboard\IndexController as DashboardIndexController;
use App\Http\Controllers\Dashboard\CirculationController as DashboardCirculationController;
use App\Http\Controllers\Dashboard\MemberController as DashboardMemberController;
use App\Http\Controllers\Dashboard\BookController as DashboardBookController;

use App\Http\Controllers\Dashboard\Report\BookController as DashboardBookReportController;
use App\Http\Controllers\Dashboard\Report\TransactionController as DashboardTransactionReportController;
use App\Http\Controllers\Dashboard\Report\MemberController as DashboardMemberReportController;
use App\Http\Controllers\Dashboard\Report\VisitorController as DashboardVisitorReportController;

use App\Http\Controllers\Dashboard\Settings\AccountController as DashboardAccountSettingsController;
use App\Http\Controllers\Dashboard\Settings\GeneralController as DashboardGeneralSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/',
    [IndexController::class, 'index']
)->name('main');

Route::get('/cari',
    [IndexController::class, 'search']
)->name('cari');

Route::get('/buku/{book}',
    [IndexController::class, 'show']
)->name('deskripsi');

Route::get('/pengunjung',
    [VisitorController::class, 'index']
)->name('pengunjung');

Route::post('/pengunjung',
    [VisitorController::class, 'store']
)->name('pengunjung.store');

Route::get('/tentang',
    [IndexController::class, 'about']
)->name('tentang');

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

Route::post('/dashboard/anggota/import',
    [DashboardMemberController::class, 'import']
)->middleware(['role:Admin, Petugas'])->name('anggota.import');

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

Route::get('/dashboard/anggota/import', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

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

Route::post('/dashboard/buku/import',
    [DashboardBookController::class, 'import']
)->middleware(['role:Admin, Petugas'])->name('buku.import');

Route::put('/dashboard/buku/{book}/edit',
    [DashboardBookController::class, 'update']
)->middleware(['role:Admin, Petugas'])->name('buku.update');

Route::delete('/dashboard/buku/{book}/hapus',
    [DashboardBookController::class, 'destroy']
)->middleware(['role:Admin, Petugas'])->name('buku.destroy');

// 404

Route::get('/dashboard/buku/import', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

Route::get('/dashboard/buku/{book}/edit', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

Route::get('/dashboard/buku/{book}/hapus', function () {
    return abort(404);
})->middleware(['role:Admin, Petugas']);

/*
|--------------------------------------------------------------------------
| Book Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/buku',
    [DashboardBookReportController::class, 'index']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.buku');

Route::get('/dashboard/laporan/buku/cetak',
    [DashboardBookReportController::class, 'getReport']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.buku.pdf');

/*
|--------------------------------------------------------------------------
| Transaction Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/transaksi',
    [DashboardTransactionReportController::class, 'index']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.transaksi');

Route::get('/dashboard/laporan/transaksi/cetak',
    [DashboardTransactionReportController::class, 'getReport']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.transaksi.pdf');

/*
|--------------------------------------------------------------------------
| Member Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/anggota',
    [DashboardMemberReportController::class, 'index']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.anggota');

Route::get('/dashboard/laporan/anggota/cetak',
    [DashboardMemberReportController::class, 'getReport']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.anggota.pdf');

/*
|--------------------------------------------------------------------------
| Visitor Report Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/laporan/pengunjung',
    [DashboardVisitorReportController::class, 'index']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.pengunjung');

Route::get('/dashboard/laporan/pengunjung/cetak',
    [DashboardVisitorReportController::class, 'getReport']
)->middleware(['role:Admin, Petugas, Kepala Sekolah'])->name('laporan.pengunjung.pdf');

/*
|--------------------------------------------------------------------------
| Account Settings Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/pengaturan/akun',
    [DashboardAccountSettingsController::class, 'index']
)->middleware(['role:Admin'])->name('pengaturan.akun');

Route::post('/dashboard/pengaturan/akun',
    [DashboardAccountSettingsController::class, 'store']
)->middleware(['role:Admin'])->name('pengaturan.akun.store');

Route::put('/dashboard/pengaturan/akun/{user}/edit',
    [DashboardAccountSettingsController::class, 'update']
)->middleware(['role:Admin'])->name('pengaturan.akun.update');

Route::delete('/dashboard/pengaturan/akun/{user}/hapus',
    [DashboardAccountSettingsController::class, 'destroy']
)->middleware(['role:Admin'])->name('pengaturan.akun.destroy');

// 404

Route::get('/dashboard/pengaturan/akun/{user}/edit', function () {
    return abort(404);
})->middleware(['role:Admin']);

Route::get('/dashboard/pengaturan/akun/{user}/hapus', function () {
    return abort(404);
})->middleware(['role:Admin']);

/*
|--------------------------------------------------------------------------
| General Settings Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard/pengaturan/umum',
    [DashboardGeneralSettingsController::class, 'index']
)->middleware(['role:Admin'])->name('pengaturan.umum');

Route::put('/dashboard/pengaturan/umum',
    [DashboardGeneralSettingsController::class, 'update']
)->middleware(['role:Admin'])->name('pengaturan.umum.update');

Route::patch('/dashboard/pengaturan/umum/upload-logo',
    [DashboardGeneralSettingsController::class, 'updateLogo']
)->middleware(['role:Admin'])->name('pengaturan.umum.logo');

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
