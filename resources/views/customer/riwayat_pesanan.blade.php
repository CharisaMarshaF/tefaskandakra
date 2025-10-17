@extends('layouts.costumer.app')

@section('title', 'Riwayat Pesanan')

@section('content')

<!-- Breadcrumb -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
    <div class="max-container">
        <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Riwayat Pesanan</li>
        </ol>
    </div>
</div>

<!-- Riwayat Pesanan Table -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="form-card p-4">
            <h4 class="mb-2 fw-bold">Riwayat Pesanan</h4>
            <p class="text-muted mb-4">
                Berikut adalah riwayat pesanan Anda.
            </p>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="rounded-start">Nomor Pesanan</th>
                            <th>Barang</th>
                            <th>Status</th>
                            <th>Tanggal Pengiriman</th>
                            <th>ID Pelacakan</th>
                            <th class="rounded-end">Harga</th>
                            <th></th>
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
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-warning
                                        @elseif($order->status == 'diproses') bg-primary
                                        @elseif($order->status == 'dikirim') bg-success
                                        @else bg-secondary @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->updated_at)->addDays(4)->format('d-m-Y') }}
                                    <br><small class="text-muted">(estimasi)</small>
                                </td>
                                <td>
                                    {{ $order->order_no ?? '-' }}
                                </td>
                                <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                             
                                    <td>
                                        <a href="{{ route('customer.produk.detail', ['id' => $item->id_produk]) }}" class="text-decoration-none fw-semibold ms-3">
                                            Pesan Ulang <i class="fa fa-arrow-right"></i>
                                        </a>
                                        
                                    </td>
                                    
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
