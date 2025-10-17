<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Guru\TeacherController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Siswas\SiswasController;
use App\Http\Controllers\Siswa\DashboardController;
use App\Http\Controllers\waka\SertifikatController;
use App\Http\Controllers\Customer\CustomerController;


use App\Http\Controllers\Admintefa\BahanController;
use App\Http\Controllers\Admintefa\SigurController;
use App\Http\Controllers\Admintefa\ProdukController;
use App\Http\Controllers\Admintefa\ProduksiController;
use App\Http\Controllers\Admintefa\PemesananController;
use App\Http\Controllers\Admintefa\PembayaranController;
use App\Http\Controllers\Admintefa\PengirimanController;
///

use App\Http\Controllers\waka\NilaiProjectController;
use App\Http\Controllers\OrangTuas\OrangTuaController;
use App\Http\Controllers\Siswa\SiswaProjectController;
use App\Http\Controllers\Siswa\KelasIndustriController;
use App\Http\Controllers\Siswa\SiswaNilaiProjectController;
use App\Http\Controllers\waka\JadwalProduksiTefaController;
use App\Http\Controllers\waka\JadwalKelasIndustriController;
use App\Http\Controllers\Siswa\SiswaProjectProgressController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Guru\DashboardController as DashboardTeacherController;


Route::get('/', [CustomerController::class, 'landingPage']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
});

// ... (sisanya tidak perlu diubah)

// Dashboard untuk tiap role
Route::middleware(['auth', 'role:1'])->group(function () {
        // PRODUK
    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


        // STOK
    Route::get('stok', [BahanController::class, 'index']);
    Route::post('stok', [BahanController::class, 'store'])->name('stok.store');
    Route::post('stok/tambah', [BahanController::class, 'tambahStok'])->name('tambahStok');
    Route::delete('stok/{id}', [BahanController::class, 'hapusBahan'])->name('hapusBahan');
    Route::put('stok/{id}', [BahanController::class, 'edit'])->name('edit');
    Route::put('stok/{id}', [BahanController::class, 'update'])->name('update');


        // PEMESANAN
    Route::get('pemesanan', [PemesananController::class, 'index']);
    Route::put('pemesanan/{id}/konfirmasi', [PemesananController::class, 'konfirmasi'])->name('konfirmasi');
    Route::put('pemesanan/{id}/dikirim', [PemesananController::class, 'dikirim'])->name('dikirim');
    Route::put('pemesanan/{id}/selesai', [PemesananController::class, 'selesai'])->name('selesai');


        // PEMBAYARAN
    Route::get('pembayaran',[PembayaranController::class,'index']);
    Route::put('pembayaran/{id}/konfirmasi',[PembayaranController::class,'konfirmasi'])->name('konfirmasi');
    Route::put('pembayaran/{id}/ditolak',[PembayaranController::class,'tolak'])->name('tolak');


        // PRODUKSI
    Route::get('produksi',[ProduksiController::class,'index']);
    Route::post('produksi',[ProduksiController::class,'tambah'])->name('produksi.tambah');


        // SISWA DAN GURU
    Route::get('sigur',[SigurController::class,'index']);
    Route::post('sigur',[SigurController::class,'tambahSiswa'])->name('siswa.store');
    Route::put('sigur/{id}',[SigurController::class,'update'])->name('siswa.edit');
    Route::delete('sigur/{id}',[SigurController::class,'destroy'])->name('siswa.hapus');
    Route::post('sigur/guru',[SigurController::class,'tambahGuru'])->name('guru.store');

        // Pengiriman
    Route::get('pengiriman',[PengirimanController::class,'index']);
    Route::post('pengiriman',[PengirimanController::class,'store'])->name('pengiriman.store');
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard-admin-sekolah', [AdminController::class, 'index'])->name('dashboard.admin_sekolah');
    Route::get('/laporan-admin-sekolah', [AdminController::class, 'laporan'])->name('laporan.admin_sekolah');
    Route::get('/analisis-admin-sekolah', [AdminController::class, 'analisis'])->name('analisis.admin_sekolah');
    Route::get('/user-admin-sekolah', [AdminController::class, 'user'])->name('user.admin_sekolah');

    Route::post('/user-admin-sekolah', [AdminController::class, 'store'])->name('user.admin_sekolah.store');
    Route::get('/user-admin-sekolah/{user}/edit', [AdminController::class, 'edit'])->name('user.admin_sekolah.edit');
    Route::put('/user-admin-sekolah/{user}', [AdminController::class, 'update'])->name('user.admin_sekolah.update');
    Route::delete('/user-admin-sekolah/{user}', [AdminController::class, 'destroy'])->name('user.admin_sekolah.destroy');

    Route::get('/jurusan-kelas', [JurusanController::class, 'index'])->name('jurusan.admin_sekolah');
    Route::post('/jurusan-kelas', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan-kelas/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan-kelas/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan-kelas/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    Route::post('/mitra-dudi', [MitraController::class, 'store'])->name('mitra.store');

    Route::get('/laporan-sistem', [LaporanController::class, 'index'])->name('laporan.admin_sekolah');
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard-waka', function () {
        return view('waka.Dashboard');
    });

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
    Route::get('/dashboard-guru', [DashboardTeacherController::class, 'index'])->name('dashboard.guru');
    Route::get('kelola', [TeacherController::class, 'kelola'])->name('kelola');
    Route::get('/teacher/projects/detail/{project:kode_project}', [TeacherController::class, 'showDetailProject'])->name('teacher.projects.detailProject');

    Route::get('/teacher/nilai', [TeacherController::class, 'nilai'])->name('teacher.nilai');
    Route::get('prosesProduksi', [TeacherController::class, 'prosesProduksi'])->name('prosesProduksi');
    Route::post('prosesProduksi/store', [TeacherController::class, 'storeProgress'])->name('prosesProduksi.store');
    Route::get('project-tefa', [TeacherController::class, 'projectTefa'])->name('project-tefa');
    Route::post('/teacher/projects/update-deadline', [TeacherController::class, 'updateDeadline'])->name('teacher.projects.updateDeadline');
    Route::get('project/create', [TeacherController::class, 'create'])->name('project.create');
    Route::post('teacher/project/store', [TeacherController::class, 'projectStore'])->name('teacher.projects.store');

    Route::post('/teacher/grades/store', [TeacherController::class, 'storeGrade'])->name('teacher.grades.store');

});

Route::middleware(['auth', 'role:5'])->group(function () {
    Route::get('/dashboard-kepala-sekolah', function () {
        return "Halaman khusus Kepala Sekolah";
    });
});

Route::middleware(['auth', 'role:6'])
    ->prefix('siswa')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('siswa.dashboard');

        // Kelas Industri
        // Route::prefix('kelas-industri')->group(function () {
        //     Route::get('/', [KelasIndustriController::class, 'index'])->name('siswa.kelas_industri.index');
        //     Route::get('/{id}/detail', [KelasIndustriController::class, 'detail'])->name('siswa.kelas_industri.detail');
        //     Route::get('/{id}/seleksi', [KelasIndustriController::class, 'seleksi'])->name('siswa.kelas_industri.seleksi');
        //     Route::post('/store', [KelasIndustriController::class, 'store'])->name('siswa.kelas_industri.store');
        // });

        // Project
        Route::get('/projects', [SiswaProjectController::class, 'index'])->name('siswa.projects');
        
        // Project Progress (Laporan Progres)
        Route::get('/project-progress', [SiswaProjectProgressController::class, 'index'])->name('siswa.project_progress.index');
        Route::post('/project-progress/store', [SiswaProjectProgressController::class, 'store'])->name('siswa.project-progress.store');

        Route::get('/file/download/{file}', [SiswaProjectProgressController::class, 'download'])->name('files.download');    });
        Route::get('/nilai-project', [SiswaNilaiProjectController::class, 'index'])->name('siswa.nilai_project.index');
        Route::get('/nilai-project/download/{file}', [SiswaNilaiProjectController::class, 'download'])->name('siswa.nilai_project.download');

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
    Route::get('/customer/checkout', [CustomerController::class, 'checkout'])->middleware('auth');
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
    Route::get('/customer/produk', [CustomerController::class, 'allProduk'])->name('customer.produk');
    Route::get('/search', [App\Http\Controllers\Customer\CustomerController::class, 'search'])->name('customer.search');
    
});

