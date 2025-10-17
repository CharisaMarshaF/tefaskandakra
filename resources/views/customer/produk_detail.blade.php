@extends('layouts.costumer.app')

@section('title', $produk->nama_produk ?? 'Detail Produk')

@section('content')
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
  <div class="max-container">
    <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
      <li class="breadcrumb-item"><a href="{{ route('customer.landing') }}" class="text-muted text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
      <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ $produk->nama_produk }}</li>
    </ol>
  </div>
</div>

<!-- Form Section -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
  <div class="max-container">
    <div class="form-card">
      <div class="container my-5">
        <div class="row g-4">

          <!-- Left Image -->
          <div data-aos="fade-up" class="col-lg-4">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded">
            @if($produk->galeri && count($produk->galeri) > 0)
            <div class="d-flex mt-3 gap-2">
              @foreach($produk->galeri as $g)
                <img src="{{ asset('storage/' . $g->foto) }}" alt="thumb{{ $loop->iteration }}" class="img-thumbnail" width="100">
              @endforeach
            </div>
            @endif
          </div>

          <!-- Middle: Info Produk -->
          <div data-aos="fade-up" class="col-lg-5">
            <h5 class="fw-bold">{{ $produk->nama_produk }}</h5>
            <p class="text-primary fs-5 fw-semibold">
              Rp. {{ number_format($produk->harga, 0, ',', '.') }}
            </p>

            <ul class="mb-4">
              <li>{{ $produk->fitur1 ?? 'Produk unggulan TEFA SMK 2 Karanganyar' }}</li>
              <li>{{ $produk->fitur2 ?? 'Produk terjamin' }}</li>
              <li>{{ $produk->fitur3 ?? 'Diproduksi oleh siswa berkompeten' }}</li>
            </ul>

            {{-- ✅ Tampilkan ukuran hanya jika produk memiliki ukuran --}}
            @if(!empty($produk->ukuran1) || !empty($produk->ukuran2) || !empty($produk->ukuran3))
            <h6 class="fw-semibold">UKURAN :</h6>
            <div class="d-flex gap-3 mb-3 flex-wrap">

              @if(!empty($produk->ukuran1))
              <div class="border rounded p-2 text-center size-option active">
                <img src="{{ asset('storage/' . ($produk->foto ?? 'assets/img/placeholder.png')) }}" 
                     alt="size1" width="50" class="mb-1"><br>
                {{ $produk->ukuran1 }} <br>
                <strong>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</strong>
              </div>
              @endif

              @if(!empty($produk->ukuran2))
              <div class="border rounded p-2 text-center size-option">
                <img src="{{ asset('storage/' . ($produk->foto2 ?? $produk->foto)) }}" 
                     alt="size2" width="50" class="mb-1"><br>
                {{ $produk->ukuran2 }} <br>
                <strong>Rp. {{ number_format($produk->harga2 ?? $produk->harga, 0, ',', '.') }}</strong>
              </div>
              @endif

              @if(!empty($produk->ukuran3))
              <div class="border rounded p-2 text-center size-option">
                <img src="{{ asset('storage/' . ($produk->foto3 ?? $produk->foto)) }}" 
                     alt="size3" width="50" class="mb-1"><br>
                {{ $produk->ukuran3 }} <br>
                <strong>Rp. {{ number_format($produk->harga3 ?? $produk->harga, 0, ',', '.') }}</strong>
              </div>
              @endif

            </div>
            @endif
            {{-- Akhir logika ukuran --}}

            <span class="badge bg-info text-dark mb-3">GRATIS ONGKIR</span>

            @php
              $stokAwal = ($produk->stok ?? 0) + ($produk->terjual ?? 0);
              $terjual = $produk->terjual ?? 0;
              $persen = $stokAwal > 0 ? ($terjual / $stokAwal) * 100 : 0;
            @endphp

            <div>
              <small class="text-muted">
                Terjual: {{ $terjual }} dari {{ $stokAwal }}
              </small>
              <div class="progress mt-1" style="height: 8px;">
                <div class="progress-bar bg-primary" style="width: {{ $persen }}%;"></div>
              </div>
            </div>

          </div>

          <!-- Right Sidebar Harga -->
          <div data-aos="fade-up" class="col-lg-3">
            <div class="card p-3 shadow-sm" style="background-color: #f8f9fa;">
              <h6 class="text-muted">TOTAL HARGA:</h6>
              <p class="fs-5 fw-bold text-primary">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
              <hr>
              <p class="text-success mb-3"><i class="bi bi-check-circle"></i> Stok Tersedia</p>

              <form action="{{ route('customer.keranjang.tambah', $produk->id) }}" method="POST">
                @csrf
                <div class="input-group mb-3" style="max-width: 150px;">
                  <button type="button" class="btn btn-outline-secondary minus-btn">-</button>
                  <input type="text" name="quantity" class="form-control text-center qty-input" value="1">
                  <button type="button" class="btn btn-outline-secondary plus-btn">+</button>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">
                  <i class="fa fa-cart-shopping"></i> TAMBAH KERANJANG
                </button>
              </form>

              <form action="{{ route('customer.checkout.proses') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="quantity" class="qty-input" value="1">
                <button type="submit" class="btn btn-outline-primary w-100">BELI SEKARANG</button>
              </form>

              <div class="d-flex justify-content-between align-items-center mt-3 text-muted">
                <span class="text-success"><i class="fa fa-heart"></i> Wishlist</span>
                <span><i class="fa fa-repeat"></i> Compare</span>
              </div>
              <hr>
              <small class="text-muted">Jaminan Pembayaran Aman</small>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Tabs Deskripsi, Review, Info -->
    <div data-aos="fade-up" class="form-card">
      <div class="container my-5">
        <ul class="nav nav-tabs" id="productTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc" type="button">Deskripsi</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#review" type="button">Review</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info" type="button">Informasi Tambahan</button>
          </li>
        </ul>

        <div class="tab-content border border-top-0 p-4 bg-white shadow-sm" style="border-radius: 0 0 .5rem .5rem;">
          <div class="tab-pane fade show active" id="desc">
            {!! nl2br(e($produk->deskripsi)) !!}
          </div>
          <div class="tab-pane fade" id="review">
            <p>Belum ada ulasan untuk produk ini.</p>
          </div>
          <div class="tab-pane fade" id="info">
            <p>-</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk Terkait -->
    <div data-aos="fade-up" class="form-card">
      <h4>PRODUK TERKAIT</h4>
      <div class="row row-cols-1 row-cols-md-4 g-4 text-center">
        @foreach($terkait as $p)
        <div data-aos="fade-up" class="col">
          <div class="my-3">
            <a href="{{ route('customer.produk.detail', $p->id) }}" class="text-decoration-none text-dark">
              <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top img-fluid p-3" alt="{{ $p->nama_produk }}">
              <div class="card-body d-flex flex-column">
                <p class="mb-1 text-muted small">(100)</p>
                <h6>{{ $p->nama_produk }}</h6>
                <h6 class="text-dark fw-bold">Rp. {{ number_format($p->harga, 0, ',', '.') }}</h6>
                <div class="d-flex justify-content-center flex-wrap gap-1 mb-2">
                  <span class="badge bg-success-subtle text-success fw-semibold">GRATIS ONGKIR</span>
                  <span class="badge bg-danger-subtle text-danger fw-semibold">BONUS</span>
                </div>
                <div class="mb-2 text-success fw-semibold small">✅ Stok Tersedia</div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.plus-btn').forEach(btn=>{
  btn.addEventListener('click',()=>{
    let input = btn.parentElement.querySelector('.qty-input');
    input.value = parseInt(input.value) + 1;
  });
});
document.querySelectorAll('.minus-btn').forEach(btn=>{
  btn.addEventListener('click',()=>{
    let input = btn.parentElement.querySelector('.qty-input');
    if(parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
  });
});
</script>
@endsection
