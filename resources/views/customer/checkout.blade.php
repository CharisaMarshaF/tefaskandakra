@extends('layouts.costumer.app')

@section('title', 'Checkout')

@section('content')

    <div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
        <div class="max-container">
            <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">Checkout</li>
            </ol>
        </div>
    </div>

    <!-- Form Section -->
    <div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
        <div class="max-container">
            <div class="form-card">
                <div class="row">

                    <!-- FORM KIRI -->
                    <div class="col-lg-6">
                        <div class="checkout-card">
                            <h5 class="fw-bold mb-4">RINCIAN TAGIHAN</h5>
                        <form action="{{ route('customer.checkout.proses') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', Auth::user()->username) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="2" required>{{ old('alamat_lengkap', Auth::user()->alamat_lengkap ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', Auth::user()->phone ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>


                                <!-- BUTTON -->
                                <button type="submit" class="btn-submit w-100 mt-2">PROSES CHECKOUT</button>
                            </form>
                        </div>
                    </div>

                    <!-- FORM KANAN -->
                    <div data-aos="fade-up" class="col-lg-3 aos-init aos-animate">
                        <div class="card p-3 shadow-sm" style="background-color: #f8f9fa;">
                            <div class="col-lg-6">
                                <h5 class="fw-bold mb-4">Pesanan</h5>
                                <div class="order-box">
                                    <!-- HEADER -->
                                    <div class="order-header d-flex justify-content-between fw-bold">
                                        <span>PRODUK</span>
                                        <span>SUB TOTAL</span>
                                    </div>
        
                                    <!-- LOOP ITEM PESANAN -->
                                    @forelse($keranjang as $item)
                                        <div class="order-item">
                                            <img src="{{ isset($item->produk->foto) ? asset('storage/' . $item->produk->foto->path) : asset('img/default.png') }}"
                                                alt="{{ $item->produk->nama_produk }}">
                                            <div>
                                                <div>{{ $item->produk->nama_produk }}</div>
                                                <small>x {{ $item->quantity }}</small>
                                            </div>
                                            <div class="ms-auto">Rp
                                                {{ number_format($item->produk->harga * $item->quantity, 0, ',', '.') }}</div>
                                        </div>
                                    @empty
                                        <p class="text-center p-3">Keranjang masih kosong.</p>
                                    @endforelse
        
                                    <div class="total mb-3">
                                        <span>Harga Total</span>
                                        <span>Rp
                                            {{ number_format($keranjang->sum(fn($i) => $i->produk->harga * $i->quantity), 0, ',', '.') }}</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>

        </div>
    </div>

@endsection
