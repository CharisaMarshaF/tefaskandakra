<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
});

// ... (sisanya tidak perlu diubah)

// Dashboard untuk tiap role
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard-tefa', function () {
        return "Halaman khusus Admin TEFA";
    });
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard-admin-sekolah', function () {
        return "Halaman khusus Admin Sekolah";
    });
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard-waka', function () {
        return "Halaman khusus Waka Kurikulum";
    });
});

Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/dashboard-guru', function () {
        return "Halaman khusus Guru Pembimbing";
    });
});

Route::middleware(['auth', 'role:5'])->group(function () {
    Route::get('/dashboard-kepala-sekolah', function () {
        return "Halaman khusus Kepala Sekolah";
    });
});

Route::middleware(['auth', 'role:6'])->group(function () {
    Route::get('/dashboard-siswa', function () {
        return "Halaman khusus Siswa";
    });
});

Route::middleware(['auth', 'role:7'])->group(function () {
    Route::get('/dashboard-orang-tua', function () {
        return "Halaman khusus Orang Tua";
    });
});

Route::middleware(['auth', 'role:8'])->group(function () {
    Route::get('/dashboard-perusahaan', function () {
        return "Halaman khusus Perusahaan";
    });
});

Route::middleware(['auth', 'role:9'])->group(function () {
    Route::get('/dashboard-customer', function () {
        return "Halaman khusus Customer";
    });
});
