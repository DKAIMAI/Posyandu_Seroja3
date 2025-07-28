<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kader\UserController;
use App\Http\Controllers\Kader\BalitaOrangtuaController;
use App\Http\Controllers\PendaftaranPosyanduController;
use App\Http\Controllers\Kader\RekapPendaftaranController;
use App\Http\Controllers\Kader\KegiatanPosyanduController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\Orangtua\LaporanController;

Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'kader') {
        return redirect('/kader/dashboard');
    }
    return redirect('/orangtua/dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/kader/dashboard', [DashboardController::class, 'kader'])->name('kader.dashboard');
});

Route::middleware(['auth', 'role:orangtua'])->group(function () {
    Route::get('/orangtua/dashboard', [DashboardController::class, 'orangtua'])->name('orangtua.dashboard');
});

Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/kader/tambah-user', [UserController::class, 'create'])->name('kader.tambah-user');
    Route::post('/kader/tambah-user', [UserController::class, 'store'])->name('kader.simpan-user');
});

Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/kader/tambah-balita', [BalitaOrangtuaController::class, 'create'])->name('kader.tambah-balita');
    Route::post('/kader/tambah-balita', [BalitaOrangtuaController::class, 'store'])->name('kader.simpan-balita');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran-posyandu', [PendaftaranPosyanduController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran-posyandu', [PendaftaranPosyanduController::class, 'store'])->name('pendaftaran.store');
});

Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/rekap-pendaftaran', [RekapPendaftaranController::class, 'index'])->name('rekap.pendaftaran');
});

Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/kegiatan-posyandu', [KegiatanPosyanduController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan-posyandu', [KegiatanPosyanduController::class, 'store'])->name('kegiatan.store');
});

Route::middleware(['auth', 'role:kader'])->prefix('kader')->group(function () {
    Route::get('/laporan/kegiatan', [LaporanKegiatanController::class, 'index'])->name('kader.laporan.kegiatan');
    Route::get('/kader/laporan/kegiatan/export', [LaporanKegiatanController::class, 'export'])->name('kader.laporan.export');
    Route::get('/kegiatan/{id}/edit', [LaporanKegiatanController::class, 'edit'])->name('kader.kegiatan.edit');
    Route::put('/kegiatan/{id}', [LaporanKegiatanController::class, 'update'])->name('kader.kegiatan.update');
});

Route::middleware(['auth', 'role:orangtua'])->group(function () {
    Route::get('/orangtua/laporan', [\App\Http\Controllers\Orangtua\LaporanController::class, 'index'])->name('orangtua.laporan');
});

require __DIR__.'/auth.php';
