<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswas\SiswasController;
use App\Http\Controllers\OrangTuas\OrangTuaController;
use App\Http\Controllers\Customer\CustomerController;

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
        return view('waka.Dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('waka')->group(function () {
        Route::redirect('/', '/dashboard-waka');
        Route::redirect('/dashboard', '/dashboard-waka');
        Route::resource('jadwal-kelas-industri', App\Http\Controllers\waka\JadwalKelasIndustriController::class)->except('create', 'edit');
        Route::resource('jadwal-tefa', App\Http\Controllers\waka\JadwalProduksiTefaController::class)->except('create', 'show', 'edit');
        Route::resource('nilai', App\Http\Controllers\waka\NilaiProjectController::class);
        Route::resource('sertifikat', App\Http\Controllers\waka\SertifikatController::class);
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
    Route::get('/dashboard-siswa', [SiswasController::class, 'index'])->name('siswa.index');
    Route::get('/kelasindustri', [SiswasController::class, 'kelasindustri'])->name('siswa.kelasindustri');
    Route::get('/laporan', [SiswasController::class, 'laporan'])->name('siswa.laporan');
    Route::get('/lihatnilai', [SiswasController::class, 'lihatnilai'])->name('siswa.lihatnilai');
    Route::get('/produksi', [SiswasController::class, 'produksi'])->name('siswa.produksi');

    //  Tambahkan route POST untuk upload progres
    Route::post('/laporan', [SiswasController::class, 'storeProgress'])->name('project-progress.store');
});



Route::middleware(['auth', 'role:7'])->group(function () {
    Route::get('/dashboard-orang-tua', [OrangTuaController::class, 'index']);

    Route::get('/nilai', [OrangTuaController::class, 'nilai']);

    Route::get('/riwayat', [OrangTuaController::class, 'riwayat']);

    Route::get('/surat', [OrangTuaController::class, 'surat']);
    Route::post('/surat/store', [OrangTuaController::class, 'store'])->name('surat.store');
    Route::post('/surat/{id}/approve', [OrangTuaController::class, 'approveSurat'])->name('surat.approve');
    Route::get('/surat/{id}/download', [OrangTuaController::class, 'downloadSurat'])->name('surat.download');

    Route::get('/download/sertifikat/{id}', [OrangTuaController::class, 'downloadSertifikat'])
        ->name('download.sertifikat');
});
Route::middleware(['auth', 'role:8'])->group(function () {
    Route::get('/dashboard-perusahaan', function () {
        return "Halaman khusus Perusahaan";
    });
});

Route::middleware(['auth', 'role:9'])->group(function () {
    Route::get('/landing-page', [CustomerController::class, 'landingPage'])->name('customer.landing');
    Route::get('/riwayat_pesanan', [CustomerController::class, 'riwayatpesanan'])->name('customer.riwayat_pesanan');
    Route::get('/customer/keranjang', [CustomerController::class, 'keranjang'])->name('customer.keranjang');
    Route::post('/keranjang/tambah/{id}', [CustomerController::class, 'tambahKeranjang'])->name('customer.keranjang.tambah');
    Route::put('/keranjang/update/{id}', [CustomerController::class, 'updateKeranjang'])->name('customer.keranjang.update');
    Route::delete('/keranjang/delete/{id}', [CustomerController::class, 'hapusKeranjang'])->name('customer.keranjang.delete');
    Route::get('/customer/checkout/{id?}', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::post('/customer/checkout/proses', [CustomerController::class, 'prosesCheckout'])->name('customer.checkout.proses');
    Route::get('/customer/akun', [CustomerController::class, 'akun'])->name('customer.akun');
    Route::get('/customer/jurusan_rpl', [CustomerController::class, 'jurusan_rpl'])->name('customer.jurusan_rpl');
    Route::get('/customer/jurusan_mesin', [CustomerController::class, 'jurusan_mesin'])->name('customer.jurusan_mesin');
    Route::get('/customer/jurusan_tekstil', [CustomerController::class, 'jurusan_tekstil'])->name('customer.jurusan_tekstil');
    Route::get('/customer/jurusan_oto', [CustomerController::class, 'jurusan_oto'])->name('customer.jurusan_oto');
    Route::get('/customer/kontak', [CustomerController::class, 'kontak'])->name('customer.kontak');
    Route::put('/customer/akun/update', [CustomerController::class, 'updateAkun'])->name('customer.akun.update');
    Route::get('/customer/profil_tefa', [CustomerController::class, 'profil_tefa'])->name('customer.profil_tefa');
    Route::get('/customer/customer_service', [CustomerController::class, 'customer_service'])->name('customer.customer_service');
    Route::post('/tickets/store', [CustomerController::class, 'store'])->name('tickets.store');
    Route::get('/customer/tracking', [CustomerController::class, 'tracking'])->name('customer.tracking');
    Route::get('/customer/ticket/{id}', [CustomerController::class, 'show'])->name('customer.ticket.show');
    Route::delete('/customer/ticket/{id}', [CustomerController::class, 'destroy'])->name('customer.ticket.destroy');
    Route::match(['get', 'post'], '/mitra', [CustomerController::class, 'mitra'])->name('customer.mitra');
    Route::get('/customer/jurusan/{id}', [CustomerController::class, 'jurusan'])->name('customer.jurusan');
    Route::post('/checkout/pay', [CustomerController::class, 'pay'])->name('customer.checkout.pay');
    Route::get('/customer/payment/{order}', [CustomerController::class, 'payment'])->name('customer.payment');
    Route::get('/customer/landing', [CustomerController::class, 'landingPage'])->name('customer.landing');
    Route::get('/produk/{id}', [CustomerController::class, 'produkDetail'])->name('customer.produk.detail');
    Route::get('/lacak-pesanan', [CustomerController::class, 'lacakPesanan'])->name('lacak.pesanan');
    Route::get('/produk', [CustomerController::class, 'allProduk'])->name('customer.produk');
    Route::get('/search', [App\Http\Controllers\Customer\CustomerController::class, 'search'])->name('customer.search');
    
});

