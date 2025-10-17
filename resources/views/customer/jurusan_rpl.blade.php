


@extends('layouts.costumer.app')

@section('title', 'Jurusan Rpl')

@section('content')


<div data-aos="fade-up" class="hero-section" style="margin-top: 20px; margin-bottom: 60px;">
    <div class="container py-5">
      <div class="row align-items-center" style="min-height: 400px;">
        <div class="col-md-6 hero-text">
          <div class="subtitle mb-2">SMKN 2 Karanganyar – Sekolah Pusat Keunggulan</div>
          <h1 class="title">Rekayasa Perangkat <br /> Lunak (RPL)</h1>
          <ul class="mb-4" style="list-style-type: disc; padding-left: 1.5rem; color: #4b515d;">
            <li>Pembuatan Website & Company Profile – Website profesional dan user-friendly untuk kebutuhan bisnis
              maupun instansi.</li>
            <li>Sistem Informasi (Web, Desktop, Mobile) – Solusi digital terintegrasi untuk mendukung operasional dan
              manajemen.</li>
            <li>Aplikasi Custom – Pengembangan aplikasi sesuai kebutuhan spesifik pengguna atau perusahaan.</li>
          </ul>
          <div class="hero-buttons d-flex">
            <a href="#layanan" class="btn-submit">Pelayanan Kami</a>
            <a href="{{ route('customer.landing') }}" class="btn btn-outline-secondary mx-3">Tentang TeFa</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="image-container">
            <img src="{{ asset('img/image.png') }}" alt="Hero RPL" class="hero-img" style="max-width: 500px;">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div data-aos="fade-up" id="layanan" style="background-color: white; padding-top: 25px;">
    <section class="container my-5">
      <h2 class="text-center mb-3">Semua Produk</h2>
      <p class="text-center mb-4 text-secondary">
        Layanan profesional dalam pembuatan dan pengembangan aplikasi berbasis web, desktop, dan mobile. Layanan kami
        meliputi:
      </p>
      <div class="row gx-4 gy-4 align-items-center mb-4">
        <!-- Kiri: Card Gradient -->
        <div data-aos="fade-up" class="col-lg-8">
          <div class="d-flex align-items-center p-4 rounded-4 shadow"
            style="background: linear-gradient(90deg, #b2f0e6 0%, #e0f7fa 100%); max-height: 350px;">
            <div class="flex-grow-1">
              <h5 class="fw-bold mb-2" style="color:#222">WEBSITE & SISTEM <br> INFORMASI</h5>
              <p class="mb-3" style="font-size: 0.95rem; color:#222;">
                DARI COMPANY PROFILE, <br> E-COMMERCE, HINGGA APLIKASI <br> ONLINE
              </p>
              <a href="#layanan" class="btn btn-dark">SEMUA PRODUK</a>
            </div>
            <img src="{{ asset('img/download__1_-removebg-preview 1.png') }}" alt="Preview Website"
              style="max-width: 400px; margin-left: 10px; margin-right: 52px;">
          </div>
        </div>
        <!-- Kanan: Card Basis Aplikasi -->
        <div data-aos="fade-up" class="col-lg-4">
          <div class="bg-white rounded-4 shadow-sm p-4 h-100" style="max-height: 350px;">
            <h6 class="mb-3 fw-bold" style="color:#222;">BASIS APLIKASI</h6>
            <div style="border: 2px solid #1abc9c; width: 70%;"></div> <br>
            <ul class="list-unstyled basis-app mb-0">
              <li><i class="fas fa-mobile-alt"></i> MOBILE</li>
              <li><i class="fas fa-globe"></i> WEBSITE</li>
              <li><i class="fas fa-desktop"></i> DESKTOP</li>
            </ul>
          </div>
        </div>
      </div><br>
      <!-- Produk Cards -->
      <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($produk as $item)
          <div class="col">
            <div class="card product-card h-100 shadow-sm border-0">
              <img src="{{ $item->foto ? asset('storage/'.$item->foto->path) : asset('img/default.png') }}" 
                   class="card-img-top" 
                   alt="{{ $item->nama_produk }}">
              <div class="card-body">
                <h6 class="card-title fw-bold">{{ $item->nama_produk }}</h6>
                <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                <ul>
                  <li>Kategori: {{ $item->kategori }}</li>
                  <li>Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</li>
                  <li>Stok: {{ $item->stok }}</li>
                </ul>
                <a href="{{ route('customer.produk.detail', $item->id) }}" 
                  class="btn btn-outline-success w-50">Beli</a>
               
              </div>
            </div>
          </div>
        @empty
          <p class="text-center">Belum ada produk untuk jurusan ini.</p>
        @endforelse
      </div>
      

     
    </section>
  </div><br>
  <!-- Produk Section -->


  @endsection