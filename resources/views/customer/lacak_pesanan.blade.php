@extends('layouts.costumer.app')

@section('title', 'Lacak Pesanan')

@section('content')

<div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
    <div class="max-container">
        <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Pesanan Mendatang</li>
        </ol>
    </div>
</div>

<!-- Form Section -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="form-card ">
            <h4 class="mb-2" style="font-weight:600;">Pesanan Mendatang</h4>
            <p class="text-muted mb-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet dolore magna aliquam erat volutpat.
            </p>

            <a href="{{ route('customer.riwayat_pesanan') }}"><h6 class="mb-4">Riwayat Pesanan</h6></a>
                <div style="overflow-x:auto;">

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="rounded-start">Nomor Pesanan</th>
                                    <th>Barang</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>ID Pelacakan</th>
                                    <th class="rounded-end">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->produk->foto ? asset('storage/' . $item->produk->foto) : asset('assets/img/placeholder.png') }}"
                                                    alt="{{ $item->produk->nama_produk }}" class="me-2"
                                                    style="width:40px; height:40px; border-radius:4px;">
                                                <span>{{ $item->produk->nama_produk }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $order->estimasi_pengiriman ? $order->estimasi_pengiriman->format('d-m-Y') : '-' }}<br>
                                            <small class="text-muted">(estimasi)</small>
                                        </td>
                                        
                                        <td>
                                            {{ $order->order_no ?? '-' }} 🔗
                                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                                        </td>
                                        <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pesanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>


        </div>

    </div>
</div>


@endsection