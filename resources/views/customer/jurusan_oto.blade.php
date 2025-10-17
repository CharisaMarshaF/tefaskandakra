@extends('layouts.costumer.app')

@section('title', 'Jurusan Ototronik')

@section('content')

<div data-aos="fade-up" class="hero-section" style="margin-top: 20px; margin-bottom: 60px;">
  <div class="container py-5">
    <div class="row align-items-center" style="min-height: 400px;">
      <div class="col-md-6 hero-text">
        <div class="subtitle mb-2">SMKN 2 Karanganyar – Sekolah Pusat Keunggulan</div>
        <h1 class="title">Teknik <br>Ototronik</h1>
        <ul class="mb-4" style="list-style-type: disc; padding-left: 1.5rem; color: #4b515d;">
          <li>Perawatan, perbaikan, dan servis kendaraan dengan sistem otomasi modern.</li>
          <li>Jasa diagnosa sistem elektronik, kelistrikan, dan kontrol kendaraan.</li>
          <li>Produk inovatif hasil karya siswa, seperti rangkaian kontrol otomatis berbasis sensor.</li>
        </ul>
        <div class="hero-buttons d-flex">
          <a href="#layanan" class="btn-submit">Pelayanan Kami</a>
          <a href="{{ route('customer.landing') }}" class="btn btn-outline-secondary mx-3">Tentang TeFa</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="image-container">
          <img src="{{ asset('img/hero_oto2.png') }}" alt="Hero ototronik" class="hero-img" style="max-width: 500px;">
        </div>
      </div>
    </div>
  </div>
</div>


<div data-aos="fade-up" id="layanan" style="background-color: white; padding-top: 25px;">
  <section class="container my-5">
    <h2 class="text-center mb-3">Semua Produk</h2>
    <p class="text-center mb-4 text-secondary">
      Layanan profesional di bidang Ototronik yang meliputi perawatan, perbaikan, serta inovasi sistem otomasi 
      kendaraan dengan standar industri. Kami menghadirkan karya siswa Teknik Ototronik SMKN 2 Karanganyar yang 
      berdaya guna dan siap bersaing di dunia industri.
    </p>

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
