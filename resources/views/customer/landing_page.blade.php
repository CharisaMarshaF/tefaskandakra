@extends('layouts.costumer.app')

@section('title', 'Landing Page')

@section('content')
    <style>
        /* --- Service Card Styles --- */
        .service-card {
            position: relative;
        }

        .service-card .card-img {
            height: 250px;
            object-fit: cover;
        }

        .service-card .card-img-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
            overflow: hidden;
        }

        /* --- Carousel Styles --- */
        .carousel-container {
            width: 100%;
            max-width: 1000px;
            margin: 50px auto;
            overflow: hidden;
            position: relative;
            height: 480px;
        }

        .carousel {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .card-slider {
            position: absolute;
            top: 0;
            left: 50%;
            padding-bottom: 20px;
            transform: translateX(-50%) scale(0.85);
            width: 300px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            opacity: 0;
            transition: all 0.5s ease;
            z-index: 0;
        }

        .card-slider.center {
            transform: translateX(-50%) scale(1);
            z-index: 3;
            opacity: 1;
        }

        .card-slider.left {
            transform: translateX(-110%) scale(0.9);
            z-index: 1;
            opacity: 0.7;
        }

        .card-slider.right {
            transform: translateX(10%) scale(0.9);
            z-index: 1;
            opacity: 0.7;
        }

        /* Dots Navigation */
        .dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .dot.active {
            background-color: #333;
        }

        /* Custom Header */
        .custom-header {
            padding: 20px 20px;
            font-weight: 600;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            margin: 0;
        }

        /* Image Gallery Styles */
        .image-main-container {
            position: relative;
            text-align: center;
        }

        .price-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background-color: #0d6efd;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
            z-index: 10;
        }

        .thumbnail-images img {
            cursor: pointer;
            max-width: 80px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: border-color 0.3s;
        }

        .thumbnail-images img:hover {
            border-color: #0d6efd;
        }

        .side-images img {
            border-radius: 12px;
            margin-bottom: 12px;
            width: 100%;
            object-fit: cover;
        }

        .service-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Line Button Wrapper */
        .line-button-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2rem;
        }

        .line {
            flex: 1;
            height: 2px;
            background-color: #e0e0e0;
            margin: 0 1rem;
        }

        .btn-custom {
            color: white;
            border: none;
            border-radius: 999px;
            padding: 1rem 3rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-custom:hover {
            background-color: white;
        }

        /* Responsive Carousel */
        @media (max-width: 768px) {
            .carousel-container {
                height: auto !important;
                overflow: visible !important;
            }

            .carousel {
                display: flex;
                flex-direction: column;
                gap: 20px;
                position: static !important;
                height: auto !important;
                align-items: center;
            }

            .card-slider {
                position: static !important;
                transform: none !important;
                opacity: 1 !important;
                width: 90% !important;
                max-width: 350px;
                margin: 0 auto;
                height: auto !important;
            }

            .dots {
                display: none !important;
            }

            .thumbnail-images {
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
            }

            .thumbnail-images img {
                width: 60px;
                height: 60px;
                margin: 5px;
            }

            .image-main-container img {
                height: 280px;
            }
        }

        /* Scroll margin for sections */
        section {
            scroll-margin-top: 80px;
        }

        /* Product Card Enhancements */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>

    <!-- Content -->
    <div class="container">
        <div class="row g-4 mt-1">
            <!-- Sidebar Kategori -->
            <div class="col-md-3">
                <h4 class="fw-bold my-3">Kategori</h4>
                <div class="my-3"
                    style="width: 100%; height: 2px; border-radius: 4px; background: linear-gradient(to right, #4B3EC4 50%, #ddd 50%); margin-bottom: 15px;">
                </div>
                <div class="card shadow-lg rounded-3 p-3">
                    <div class="list-group">
                        <a style="text-decoration: none;" href="#tekstil">
                            <div style="background-color: #fdfdfd;"
                                class="list-group-item d-flex align-items-center justify-content-between border-0 rounded p-3 my-2 shadow">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-warning fs-4"><i class="fas fa-tshirt"></i></span>
                                    <span style="font-weight: bold;">Tekstil</span>
                                </div>
                                <span class="badge rounded-pill bg-light text-warning fw-bold shadow-sm">1</span>
                            </div>
                        </a>
                        <a style="text-decoration: none;" href="#mesin">
                            <div style="background-color: #fdfdfd;"
                                class="list-group-item d-flex align-items-center justify-content-between border-0 rounded p-3 my-2 shadow">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-primary fs-4"><i class="fas fa-cogs"></i></span>
                                    <span style="font-weight: bold;">Mesin</span>
                                </div>
                                <span class="badge rounded-pill bg-light text-primary fw-bold shadow-sm">1</span>
                            </div>
                        </a>
                        <a style="text-decoration: none;" href="#rpl">
                            <div style="background-color: #fdfdfd;"
                                class="list-group-item d-flex align-items-center justify-content-between border-0 rounded p-3 my-2 shadow">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-success fs-4"><i class="fas fa-code"></i></span>
                                    <span style="font-weight: bold;">RPL</span>
                                </div>
                                <span class="badge rounded-pill bg-light text-success fw-bold shadow-sm">1</span>
                            </div>
                        </a>
                        <a style="text-decoration: none;" href="#ototronik">
                            <div style="background-color: #fdfdfd;"
                                class="list-group-item d-flex align-items-center justify-content-between border-0 rounded p-3 my-2 shadow">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-danger fs-4"><i class="fas fa-robot"></i></span>
                                    <span style="font-weight: bold;">Ototronik</span>
                                </div>
                                <span class="badge rounded-pill bg-light text-danger fw-bold shadow-sm">1</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carousel Section -->
            <div class="col-md-9">
                <div class="carousel-container">
                    <div class="carousel" id="carousel">
                        <div class="card card-slider">
                            <div class="card-header rounded-top-3 text-white fw-bold"
                                style="background-color: #FFAE00; padding: 10px;">
                                TEKSTIL
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('img/landing_page/lurik.png') }}" style="height: 25%; width: 25%;"
                                    alt="Produk Tekstil" class="img-fluid mb-3">
                                <h3 class="fs-5">Kain Lurik</h3>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mx-3">
                                    <p class="mb-0 fw-semibold text-success">Rp. 250.000,-</p>
                                    {{-- <button class="btn btn-outline-success mx-3">BELI</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card card-slider">
                            <div class="card-header rounded-top-3 text-white fw-bold"
                                style="background-color: #10C350; padding: 10px;">
                                RPL
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('img/p.png') }}" alt="Produk RPL" class="img-fluid mb-3">
                                <h3 class="fs-5">Produk RPL</h3>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mx-3">
                                    <p class="mb-0 fw-semibold text-success">Rp. 250.000,-</p>
                                    {{-- <button class="btn btn-outline-success mx-3">BELI</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card card-slider">
                            <div class="card-header rounded-top-3 text-white fw-bold"
                                style="background-color: #426EFF; padding: 10px;">
                                MESIN
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('img/landing_page/jemuran.png') }}" style="width: 50%; height: 50%;"
                                    alt="Produk Mesin" class="img-fluid mb-3">
                                <h3 class="fs-5">Produk Mesin</h3>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mx-3">
                                    <p class="mb-0 fw-semibold text-success">Rp. 250.000,-</p>
                                    {{-- <button class="btn btn-outline-success mx-3">BELI</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card card-slider">
                            <div class="card-header rounded-top-3 text-white fw-bold"
                                style="background-color: #FF3C42; padding: 10px;">
                                OTOTRONIK
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('img/p.png') }}" alt="Produk Ototronik" class="img-fluid mb-3">
                                <h3 class="fs-5">Produk Ototronik</h3>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mx-3">
                                    <p class="mb-0 fw-semibold text-success">Rp. 250.000,-</p>
                                    {{-- <button class="btn btn-outline-success mx-3">BELI</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dots">
                        <span class="dot active" onclick="goToSlide(0)"></span>
                        <span class="dot" onclick="goToSlide(1)"></span>
                        <span class="dot" onclick="goToSlide(2)"></span>
                        <span class="dot" onclick="goToSlide(3)"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tekstil Section -->
        <section id="tekstil" class="my-5">
            <div class="row g-3 align-items-center">
                <div data-aos="fade-up" class="col-12">
                    <div class="card w-100" style="max-height: 470px;">
                        <div class="card-header custom-header" style="background-color: #FFAE00; color: white;">
                            <h4 class="mb-0">PRODUK JURUSAN TEKSTIL</h4>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-5 d-flex">
                                    <div class="thumbnail-images d-flex flex-column align-items-center me-3">
                                        <img src="{{ asset('img/landing_page/kain1.jpg') }}" alt="Kain 1"
                                            class="img-fluid mb-3" />
                                        <img src="{{ asset('img/landing_page/kain4.jpg') }}" alt="Kain 4"
                                            class="img-fluid" />
                                        <img src="{{ asset('img/landing_page/kain5.jpg') }}" alt="Kain 5"
                                            class="img-fluid" />
                                        <img src="{{ asset('img/landing_page/kain6.jpg') }}" alt="Kain 6"
                                            class="img-fluid" />
                                    </div>
        
                                    <div class="image-main-container flex-fill position-relative d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('img/landing_page/kain2.jpg') }}" alt="Kain Utama"
                                            class="img-fluid rounded"
                                            style="max-height: 300px; object-fit: cover;">
                                    </div>
                                </div>
        
                                <div class="col-md-7">
                                    <h5 style="margin-bottom: 20px;">Batik Lurik - Tekstil SMK N 02 Karanganyar</h5>
                                    <h4 class="fw-bold my-4 text-warning">Rp. 250.000,-</h4>
                                    <ul>
                                        <li>Desain halus dan tahan lama</li>
                                        <li>Produksi asli siswa TEFA SMK 2 Karanganyar</li>
                                    </ul>
                                    <button class="btn btn-warning mb-2">Cokelat</button>
                                    <button class="btn btn-warning mb-2">GRATIS ONGKIR</button>
                                    <hr>
                                    <div class="mb-1">Terjual: <strong>26 / 50</strong></div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width: 52%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        <!-- Header Tekstil -->
        <div class="card d-flex justify-content-center align-items-center text-center mb-4"
            style="background-color: #FFAE00; color: white; border-radius: 20px; height: 100px;">
            <h4>HASIL PRODUK JURUSAN TEKNIK TEKSTIL</h4>
        </div>

        <!-- Produk Grid Tekstil -->
        <div class="container my-5">
            <div class="card border-0 p-4">
                <div class="row row-cols-1 row-cols-md-4 g-4 text-center">
                    @forelse ($tekstilProduks ?? [] as $produk)
                        <div data-aos="fade-up" class="col">
                            <div>
                                <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('img/default.jpg') }}"
                                    class="card-img-top img-fluid p-3" style="max-height: 200px; border-radius: 30px;"
                                    alt="{{ $produk->nama_produk }}">
                                <div class="card-body d-flex flex-column">
                                    <p class="mb-1 text-muted small">({{ $produk->stok }})</p>
                                    <h6>{{ $produk->nama_produk }}</h6>
                                    <h6 class="text-dark fw-bold">Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                    </h6>
                                    <div class="d-flex justify-content-center flex-wrap gap-1 mb-2">
                                        <span class="badge bg-success-subtle text-success fw-semibold">GRATIS ONGKIR</span>
                                        <span class="badge bg-danger-subtle text-danger fw-semibold">BONUS</span>
                                    </div>
                                    <div class="mb-2 text-success fw-semibold small">
                                        ✅ {{ $produk->stok > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 mt-auto">
                                        {{-- Thumbnail variants can be added here --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada produk untuk jurusan ini.</p>
                        </div>
                    @endforelse
                </div>
                <div class="line-button-wrapper">
                    <div class="line"></div>
                    <a href="{{ route('customer.jurusan_tekstil') }}" class="btn btn-warning rounded-pill py-3 px-5"
                        style="font-weight: 500; color: white; background-color: #ff9900;">
                        SEMUA PRODUK
                    </a>
                    <div class="line"></div>
                </div>
            </div>
        </div>

        <section id="rpl" data-aos="fade-up" class="card">
            <div class="card-header pt-4" style="background-color: #10C350; color: white; padding: 20px 20px;">
                <h5>PRODUK REKAYASA PERANGKAT LUNAK</h5>
            </div>
            <div class="card-body">
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
                                <a href="{{ route('customer.jurusan_rpl') }}" class="btn btn-dark">SEMUA PRODUK</a>
                            </div>
                            <img src="{{ asset('img/download__1_-removebg-preview 1.png') }}"
                                class="img-fluid d-none d-md-block" alt="Preview Website"
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
                </div>
            </div>
        </section>

        <div class="card px-4 my-3">
            <div class="row row-cols-1 row-cols-md-4 g-4 my-3">
                @foreach ($rplProduks as $produk)
                    <div data-aos="fade-up" class="col">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . ($produk->foto->path ?? 'default.jpg')) }}"
                                class="card-img-top" alt="{{ $produk->nama_produk }}">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $produk->nama_produk }}</h6>
                                <p>{{ Str::limit($produk->deskripsi, 80) }}</p>
                                <ul>
                                    <li>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                    <li>Stok: {{ $produk->stok }}</li>
                                    <li>Status: {{ ucfirst($produk->status) }}</li>
                                </ul>
                                <a href="{{ route('customer.produk.detail', ['id' => $produk->id]) }}" class="btn btn-outline-success w-50">BELI</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="row g-4">
            <section id="mesin" class="container my-5">
                <div class="row g-3 align-items-center">
                    <!-- Card untuk gambar produk + detail produk -->
                    <div data-aos="fade-up" class="col-md-9">
                        <div class="card" style="max-height: 470PX;">
                            <div class="card-header custom-header" style="background-color: #426EFF; color: white;">
                                <h4 class="mb-0">PRODUK JURUSAN MESIN</h4>
                            </div>

                            <div class="card-body" style="padding: 30px;">
                                <div class="row g-3 align-items-center">
                                    <!-- Bagian kiri: gambar produk -->
                                    <div class="col-md-5 d-flex">
                                        <div class="thumbnail-images d-flex flex-column align-items-center me-3">
                                            <img src="{{ asset('img/landing_page/jemuran1.png') }}" alt="Jemuran 1"
                                                class="img-fluid mb-3" />
                                            <img src="{{ asset('img/landing_page/jemuran2.png') }}" alt="Jemuran 2"
                                                class="img-fluid mb-3" />
                                            <img src="{{ asset('img/landing_page/jemuran3.png') }}" alt="Jemuran 3"
                                                class="img-fluid" />
                                        </div>
                                        <div class="image-main-container flex-fill position-relative">
                                            <img src="{{ asset('img/landing_page/jemuran.png') }}" alt="Jemuran utama"
                                                class="img-fluid rounded" />
                                        </div>
                                    </div>

                                    <!-- Bagian tengah: detail produk -->
                                    <div class="col-md-7">
                                        <h5 style="margin-bottom: 20px;">Jemuran Stainless Steel Lipat – TEFA SMK 2
                                            Karanganyar</h5>
                                        <h4 class="text-primary fw-bold my-4">Rp. 250.000,-</h4>
                                        <ul>
                                            <li>Desain kokoh dan tahan</li>
                                            <li>Dapat dilipat sehingga hemat ruang</li>
                                            <li>Produksi asli siswa TEFA SMK 2 Karanganyar</li>
                                        </ul>
                                        <button class="btn btn-primary mb-2">GRATIS ONGKIR</button>
                                        <hr>
                                        <div class="mb-1">
                                            Terjual : <strong>26 / 50</strong>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" style="width: 52%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian kanan: foto mesin di luar card -->
                    <div data-aos="fade-up" class="col-md-3 side-images">
                        <div class="row">
                            <img src="{{ asset('img/landing_page/mesin1.png') }}" alt="Mesin 1"
                                class="img-fluid h-25 rounded" />
                            <img src="{{ asset('img/landing_page/mesin2.png') }}" alt="Mesin 2"
                                class="img-fluid h-25 rounded" />
                            <img src="{{ asset('img/landing_page/mesin3.png') }}" alt="Mesin 3"
                                class="img-fluid h-25 rounded" />
                        </div>
                    </div>
                </div>
            </section>

            <div class="card d-flex justify-content-center align-items-center text-center"
            style="background-color: #0d6efd; color: white; border-radius: 20px; height: 100px; width: 100%;">
            <h4>HASIL PRODUK JURUSAN TEKNIK PERMESINAN</h4>
        </div>
        
        <div class="container my-5">
        
            <!-- Konten -->
            <div data-aos="fade-up" class="card border-0 p-4">
                <!-- Grid Produk -->
                <div class="row row-cols-1 row-cols-md-4 g-4 text-center">
        
                    @foreach ($mesinProduks as $produk)
                        <div data-aos="fade-up" class="col">
                            <div class="my-3">
                                <img src="{{ asset('storage/' . ($produk->foto->path ?? 'default.jpg')) }}"
                                    class="card-img-top img-fluid p-3" alt="{{ $produk->nama_produk }}">
                                <div class="card-body d-flex flex-column">
                                    <p class="mb-1 text-muted small">({{ $produk->id }})</p>
                                    <h6>{{ $produk->nama_produk }}</h6>
                                    <h6 class="text-dark fw-bold">
                                        Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                    </h6>
        
                                    <!-- Label Atas -->
                                    <div class="d-flex justify-content-center flex-wrap gap-1 mb-2">
                                        <span class="badge bg-success-subtle text-success fw-semibold">
                                            GRATIS ONGKIR
                                        </span>
                                        <span class="badge bg-danger-subtle text-danger fw-semibold">
                                            BONUS
                                        </span>
                                    </div>
        
                                    <!-- Label Bawah -->
                                    <div class="mb-2 text-success fw-semibold small">
                                        ✅ Stok Tersedia
                                    </div>
        
                                    <!-- Slot Foto Kecil -->
                                    <div class="d-flex justify-content-center gap-2 mt-auto">
                                        <img src="{{ asset('storage/' . ($produk->foto->path ?? 'default.jpg')) }}"
                                            alt="{{ $produk->nama_produk }} Varian 1" class="img-thumbnail"
                                            style="width:50px; height:50px; object-fit:cover;">
                                        <img src="{{ asset('storage/' . ($produk->foto->path ?? 'default.jpg')) }}"
                                            alt="{{ $produk->nama_produk }} Varian 2" class="img-thumbnail"
                                            style="width:50px; height:50px; object-fit:cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
        
                </div>
        
                <!-- Tombol -->
                <div class="line-button-wrapper">
                    <div class="line"></div>
                    <a href="{{ route('customer.jurusan_mesin') }}" class="btn btn-primary rounded-pill py-3 px-5"
                        style="font-weight: 500; background-color: #3366FF;">
                        SEMUA PRODUK
                    </a>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        
        </div>

        <section id="ototronik" class="card">
            <div class="card-header pt-4" style="background-color: #FF3C42; color: white; padding: 20px 20px;">
                <h5>JASA OTOTRONIK</h5>
            </div>
            <div class="card-body">
                <div class="row gx-4 gy-4 align-items-center mb-4">
                    <!-- Kiri: Card Gradient -->
                    <div data-aos="fade-up" class="col-lg-8">
                        <div class="d-flex align-items-center p-4 rounded-4 shadow"
                            style="background: linear-gradient(90deg, #ff8671 0%, #fae0e0 100%); max-height: 350px;">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-2" style="color:#222">JASA CUCI KENDARAAN <br> DAN GANTI OLI</h5>
                                <p class="mb-3" style="font-size: 0.95rem; color:#222;">
                                    LAYANAN JASA CUCI KENDARAAN DAN GANTI OLI <br> UNTUK MOBIL DAN MOTOR <br> DENGAN
                                    PELAYANAN CEPAT & PROFESIONAL
                                </p>
                                <a href="{{ route('customer.jurusan_oto') }}" class="btn btn-dark">DETAIL JASA</a>
                            </div>
                            <img src="{{ asset('img/landing_page/tools.png') }}" class="img-fluid d-none d-md-block"
                                alt="Preview Website" style="max-width: 400px; margin-left: 10px; margin-right: 52px;">
                        </div>
                    </div>
                    <!-- Kanan: Card Basis Aplikasi -->
                    <div data-aos="fade-up" class="col-lg-4">
                        <div class="bg-white rounded-4 shadow-sm p-4 h-100" style="max-height: 350px;">
                            <h6 class="mb-3 fw-bold">LAYANAN UTAMA</h6>
                            <div style="border: 2px solid #FF3C42; width: 70%;"></div> <br>
                            <ul class="list-unstyled basis-app mb-0">
                                <li><i style="color: rgb(255, 74, 74);" class="fas fa-car"
                                        style="margin-right: 8px;"></i> CUCI MOBIL</li>
                                <li><i style="color: rgb(255, 74, 74);" class="fas fa-oil-can"
                                        style="margin-right: 8px;"></i> GANTI OLI</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <div class="card px-4 my-3">
            <div class="row row-cols-1 row-cols-md-4 g-4 my-3">
        
                @foreach ($otoProduks as $produk)
                    <div data-aos="fade-up" class="col">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . ($produk->foto->path ?? 'default.jpg')) }}"
                                style="max-height: 300px;" class="card-img-top"
                                alt="{{ $produk->nama_produk }}">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $produk->nama_produk }}</h6>
                                <p>{{ $produk->deskripsi }}</p>
                                <ul>
                                    <li>Desain modern</li>
                                    <li>Responsif di semua perangkat</li>
                                    <li>Mudah dikelola</li>
                                </ul>
                                <a href="{{ route('customer.produk.detail', ['id' => $produk->id]) }}" class="btn btn-outline-danger w-50">BELI</a>
                            </div>
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
        

        <div class="card shadow-sm rounded-3 p-3" style="margin-bottom: 70px;">
            <h6 class="fw-bold mb-3">MITRA DUDI — Teaching Factory</h6>
            <div class="d-flex flex-wrap justify-content-around align-items-center">
               
                <a href="https://mdigi.tools/">
                    <img src="{{ asset('img/landing_page/mdigi.png') }}" class="img-fluid m-2" style="max-height:50px;">
                </a>
                <a href="https://www.nasmoco.co.id/">
                    <img src="{{ asset('img/landing_page/NASMOCO 1.png') }}" class="img-fluid m-2" style="max-height:50px;">
                </a>
                </a>
                {{-- <a href="https://www.nasmoco.co.id/"> --}}
                    <img src="{{ asset('img/landing_page/logo-expressa 1.png') }}" class="img-fluid m-2" style="max-height:50px;">
                </a>
            </div>
        </div>


        <!-- Continue with other sections (RPL, Mesin, Ototronik) following the same pattern -->
        {{-- ... rest of sections ... --}}

        <!-- Mitra Section -->
        
    </div>





    @push('scripts')
        <script>
            AOS.init();

            // Carousel functionality
            const cards = document.querySelectorAll('.card-slider');
            const dots = document.querySelectorAll('.dot');
            let current = 0;
            let autoplayInterval;

            function updateCarousel() {
                cards.forEach((card, i) => {
                    card.className = 'card-slider';
                    if (i === current) {
                        card.classList.add('center');
                    } else if (i === (current - 1 + cards.length) % cards.length) {
                        card.classList.add('left');
                    } else if (i === (current + 1) % cards.length) {
                        card.classList.add('right');
                    }
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === current);
                });
            }

            function changeSlide(n) {
                current = (current + n + cards.length) % cards.length;
                updateCarousel();
            }

            function goToSlide(n) {
                current = n;
                updateCarousel();
            }

            function startAutoplay() {
                autoplayInterval = setInterval(() => {
                    changeSlide(1);
                }, 4000);
            }

            function stopAutoplay() {
                clearInterval(autoplayInterval);
            }

            let isDragging = false;
            let startX = 0;
            const carousel = document.getElementById('carousel');

            carousel.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.clientX;
                stopAutoplay();
                e.preventDefault();
            });

            window.addEventListener('mouseup', (e) => {
                if (!isDragging) return;
                let diff = e.clientX - startX;
                handleGesture(diff);
                isDragging = false;
                startAutoplay();
            });

            carousel.addEventListener('touchstart', (e) => {
                isDragging = true;
                startX = e.touches[0].clientX;
                stopAutoplay();
            });

            carousel.addEventListener('touchend', (e) => {
                if (!isDragging) return;
                let diff = e.changedTouches[0].clientX - startX;
                handleGesture(diff);
                isDragging = false;
                startAutoplay();
            });

            function handleGesture(diff) {
                if (Math.abs(diff) > 50) {
                    if (diff < 0) changeSlide(1);
                    else changeSlide(-1);
                }
            }

            updateCarousel();
            startAutoplay();
        </script>
    @endpush
@endsection
