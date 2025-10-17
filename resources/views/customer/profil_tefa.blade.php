@extends('layouts.costumer.app')


@section('title', 'Tefa SMKN2Kra')

@section('content')

<!-- Hero Section -->
<div data-aos="fade-up" class="hero-section" style="margin-top: 20px; margin-bottom: 60px;">
    <div class="container py-5">
        <div class="row align-items-center" style="min-height: 400px;">

            <div class="col-md-6 hero-text">
                <div class="subtitle mb-2">SMKN 2 Karanganyar – Sekolah Pusat Keunggulan!</div>
                <h1 class="title">Tingkatkan <br> Kompetensi dan Siap <br> Bersaing di Dunia <br> Industri!</h1>
                <p class="mb-4" style="color: #4b515d;">Sebagai Sekolah Pusat Keunggulan, kami berkomitmen
                    menghadirkan produk berkualitas dengan standar industri melalui program Teaching Factory.
                    Kolaborasi dengan dunia industri menjadikan siswa lebih siap menghadapi tantangan kerja dan
                    peluang masa depan.</p>
                <div class="hero-buttons d-flex">
                    <a href="#layanan" class="btn-submit">Pelayanan Kami</a>
                    <a href="{{ route('customer.landing') }}" class="btn btn-outline-secondary mx-3">Tentang TeFa</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="image-container">
                    <img src="{{ asset('img/Rectangle 1477.png') }}" alt="Hero RPL" style="max-width: 400px;"
                        class="hero-img">
                </div>
            </div>
        </div>
    </div>
</div>

<div data-aos="fade-up" style="background-color: white; padding-top: 25px;">
    <section id="layanan" class="container my-5 shadow-sm"
        style="padding-left: 50px; padding: 20px 50px; border-radius: 20px; border: 1px solid #ececec;">
        <h1 class="text-center title">Kompetensi Pelayanan Kami</h1>
        <p class="text-center mb-4" style="color: #4b515d;">Dengan dukungan kerja sama bersama mitra industri, kami
            menghadirkan layanan dan produk yang memenuhi standar profesional. Sinergi ini menjadi langkah nyata
            dalam menyiapkan siswa yang berkompeten, berkarakter, dan siap menghadapi tantangan global.</p>
        <!-- Produk Cards -->
        <div class="row">
            <div data-aos="fade-up" class="col my-3">
                <div class="card product-card shadow border-0 h-100">
                    <img src="{{ asset('img/Rectangle 1479.png') }}" class="card-img-top" alt="Website Company Profile">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-center">REKAYASA PERANGKAT LUNAK</h6>
                        <a href="{{ route('customer.jurusan_rpl') }}" class="btn btn-success w-100 text-white">LAYANAN KAMI</a>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up" class="col my-3">
                <div class="card product-card shadow border-0 h-100">
                    <img src="{{ asset('img/Rectangle 1479 (1).png') }}" class="card-img-top" alt="Website Company Profile">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-center">TEKNIK PEMESINAN</h6>
                        <a href="{{ route('customer.jurusan_mesin') }}" class="btn btn-primary w-100 text-white">LAYANAN KAMI</a>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up" class="col my-3">
                <div class="card product-card shadow border-0 h-100">
                    <img src="{{ asset('img/Rectangle 1479 (2).png') }}" class="card-img-top" alt="Website Company Profile">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-center">TEKNIK PEMBUATAN KAIN</h6>
                        <a href="{{ route('customer.jurusan_tekstil') }}" class="btn btn-warning w-100 text-white">LAYANAN KAMI</a>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up" class="col my-3">
                <div class="card product-card shadow border-0 h-100">
                    <img src="{{ asset('img/Rectangle 1479 (3).png') }}" class="card-img-top" alt="Website Company Profile">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-center">TEKNIK OTOTRONIK</h6>
                        <a href="{{ route('customer.jurusan_oto') }}" class="btn btn-danger w-100 text-white">LAYANAN KAMI</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><br>
<!-- Produk Section -->

@endsection