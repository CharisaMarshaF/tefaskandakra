@extends('layouts.costumer.app')

@section('title', 'Produk')

@section('content')
<div data-aos="fade-up" class="container py-5">
    @if(!empty($keyword))
        <h4 class="fw-bold mb-4 text-center">
            Hasil Pencarian: <span class="text-primary">{{ $keyword }}</span>
        </h4>
    @else
        <h4 class="fw-bold mb-4 text-center">SEMUA PRODUK</h4>
    @endif
    <div class="row row-cols-1 row-cols-md-4 g-4 text-center">
        @forelse($produks as $produk)
        <div data-aos="fade-up" class="col">
            <a href="{{ route('customer.produk.detail', ['id' => $produk->id]) }}" 
               class="text-decoration-none text-dark d-block">
                <div class="form-card h-100 shadow-sm border-0 p-2 rounded-4 bg-white hover-card">
                    <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('assets/img/placeholder.png') }}" 
                         alt="{{ $produk->nama_produk }}" 
                         class="card-img-top img-fluid p-3 rounded-4" 
                         style="height:200px; object-fit:cover;">
                    <div class="card-body d-flex flex-column align-items-center">
                        {{-- <p class="mb-1 text-muted small">({{ $produk->jurusan->nama_jurusan ?? 'Umum' }})</p> --}}
                        <h6 class="fw-semibold">{{ $produk->nama_produk }}</h6>
                        <h6 class="text-dark fw-bold mb-2">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                        <div class="d-flex justify-content-center flex-wrap gap-1 mb-2">
                            <span class="badge bg-success-subtle text-success fw-semibold">GRATIS ONGKIR</span>
                            <span class="badge bg-danger-subtle text-danger fw-semibold">BONUS</span>
                        </div>
                        <div class="mb-3 text-success fw-semibold small">✅ Stok Tersedia</div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center text-muted">Belum ada produk tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.form-card {
    border-radius: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: #fff;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

.card-img-top {
    transition: transform 0.4s ease;
}

.hover-card:hover .card-img-top {
    transform: scale(1.05);
}

.badge {
    border-radius: 8px;
    font-size: 0.75rem;
    padding: 0.4em 0.6em;
}

.bg-success-subtle {
    background-color: #e8f9ee !important;
}

.bg-danger-subtle {
    background-color: #fde8e8 !important;
}

.btn-primary {
    background-color: #ff7f11;
    border: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background-color: #e86f0a;
}
</style>
@endpush
