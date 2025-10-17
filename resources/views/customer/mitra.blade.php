@extends('layouts.costumer.app')

@section('title', 'Pengajuan Mitra')

@section('content')

<!-- Breadcrumb -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
    <div class="max-container">
        <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Mitra</li>
        </ol>
    </div>
</div>

<!-- Form Section -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="form-card">
            <h5 class="text-center mb-4" style="font-weight: 600; font-size: 18px;">
                Form Pengajuan Mitra Industri (Teaching Factory)
            </h5>

           


            <form action="{{ route('customer.mitra') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="fw-semibold text-muted mb-4">Data Perusahaan</p>

                <div class="row g-4">
                    <!-- Kiri -->
                    <div class="col-md-6">
                        <label class="form-label mt-3">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_perusahaan" class="form-control mb3" required>

                        <label class="form-label mt-3">Bidang Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="bidang_usaha" class="form-control mb3" required>

                        <label class="form-label mt-3">Jenis Kerja Sama <span class="text-danger">*</span></label>
                        <input type="text" name="jenis_kerjasama" class="form-control mb3" required>

                        <label class="form-label mt-3">Jurusan Yang Dituju</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" >
                                    <label class="form-check-label" for="rpl">Rekayasa Perangkat Lunak</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" >
                                    <label class="form-check-label" for="tekstil">Teknik Pembuatan Kain</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" >
                                    <label class="form-check-label" for="mesin">Teknik Pemesinan</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" >
                                    <label class="form-check-label" for="otomotif">Teknik Otomotif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">
                        <label class="form-label mt-3">Alamat Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="alamat_perusahaan" class="form-control mb3" required>

                        <label class="form-label mt-3">Kontak Person <span class="text-danger">*</span></label>
                        <input type="text" name="kontak_person" class="form-control mb3" required>

                        <label class="form-label mt-3">No. Telp <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" class="form-control mb3" required>

                        <label class="form-label mt-3">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control mb3" required>

                        <label class="form-label mt-3">Deskripsi Kebutuhan</label>
                        <textarea name="deskripsi_kebutuhan" class="form-control mb3" rows="6"></textarea>
                    </div>

                    <!-- Upload -->
                    <div class="col-12">
                        <label class="form-label mt-3">Dokumen Pendukung</label>
                        <input type="file" name="file" class="form-control mb3">
                    </div>

                    <!-- Persetujuan -->
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="persetujuan" required>
                            <label class="form-check-label small" for="persetujuan">
                                Saya menyetujui bahwa data yang saya masukkan benar dan siap untuk dihubungi pihak sekolah
                            </label>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn-submit">SUBMIT</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection
