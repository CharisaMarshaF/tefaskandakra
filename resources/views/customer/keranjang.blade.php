@extends('layouts.costumer.app')

@section('title', 'Keranjang Belanja')

@section('content')

<div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
    <div class="max-container">
        <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Keranjang</li>
        </ol>
    </div>
</div>

<div class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="row">
        <!-- Daftar Produk -->
        <div class="col-lg-8">
            @forelse($keranjang as $item)
            <div class="form-card mb-3 position-relative">
                
                <!-- Tombol Hapus di kanan atas -->
                <form action="{{ route('customer.keranjang.delete', $item->id) }}" method="POST" 
                      class="position-absolute" style="top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-sm btn-danger rounded-circle d-flex align-items-center justify-content-center" 
                            style="width: 32px; height: 32px;" 
                            title="Hapus Produk">
                        <i class="fa-solid fa-trash text-white"></i>
                    </button>
                </form>

                <div class="d-flex">
                    <img src="{{ $item->produk->foto ? asset('storage/' . $item->produk->foto) : asset('assets/img/default.png') }}" 
                         alt="{{ $item->produk->nama_produk }}" 
                         width="120" class="me-3" />
                    <div>
                        <h6 class="fw-bold">{{ $item->produk->nama_produk }}</h6>
                        <h5 class="text-primary">Rp {{ number_format($item->produk->harga,0,',','.') }}</h5>
                        <div class="input-group mb-2" style="width: 120px;">
                            <form action="{{ route('customer.keranjang.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="minus" class="btn btn-outline-secondary">-</button>
                                <input type="text" class="form-control text-center" value="{{ $item->quantity }}" readonly />
                                <button type="submit" name="action" value="plus" class="btn btn-outline-secondary">+</button>
                            </form>
                        </div>
                        <span class="badge-ongkir">GRATIS ONGKIR</span>
                        <div class="text-success mt-1">
                            <i class="fa-solid fa-circle-check"></i> Stok Tersedia
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Keranjang Anda kosong.</p>
            <a href="{{ route('customer.landing') }}" class="btn btn-primary d-block mx-auto mt-3">Kembali ke Katalog</a>
            @endforelse
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-4">
            <div class="form-card p-3">
                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span>SubTotal :</span>
                    <span class="fw-bold">
                        Rp {{ number_format($keranjang->sum(fn($i) => $i->produk->harga * $i->quantity),0,',','.') }}
                    </span>
                </div><hr>
                <div class="d-flex justify-content-between mb-3">
                    <span>Ongkir :</span>
                    <span>-</span>
                </div><hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total Pesanan :</span>
                    <span class="fw-bold">
                        Rp {{ number_format($keranjang->sum(fn($i) => $i->produk->harga * $i->quantity),0,',','.') }}
                    </span>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="{{ route('customer.checkout') }}" method="GET">
                        <button type="submit" class="btn btn-submit mt-4">CHECKOUT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
