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
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Perusahaan <small>(Opsional)</small></label>
                                    <input type="text" name="nama_perusahaan" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Negara / Wilayah</label>
                                    <input type="text" name="negara" class="form-control" value="Indonesia">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" name="provinsi" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kota" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_pos" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="telepon" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="buatAkun">
                                    <label class="form-check-label" for="buatAkun">Buat akun?</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Pesanan <small>(Opsional)</small></label>
                                    <textarea name="catatan" class="form-control"></textarea>
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
        
        
                                    <!-- PEMBAYARAN -->
                                    <div class="payment-box">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment" id="bank" checked>
                                            <label class="form-check-label" for="bank">
                                                Transfer Bank Langsung
                                                <small class="d-block">Gunakan ID pesanan Anda sebagai referensi
                                                    pembayaran.</small>
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment" id="cod">
                                            <label class="form-check-label" for="cod">
                                                Bayar di Tempat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                      </div>
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


                            <!-- PEMBAYARAN -->
                            <div class="payment-box">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment" id="bank" checked>
                                    <label class="form-check-label" for="bank">
                                        Transfer Bank Langsung
                                        <small class="d-block">Gunakan ID pesanan Anda sebagai referensi
                                            pembayaran.</small>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment" id="cod">
                                    <label class="form-check-label" for="cod">
                                        Bayar di Tempat
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
