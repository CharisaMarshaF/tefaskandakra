
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
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>
@if ($item->produk)  <!-- Pastikan produk ada -->
    <div class="d-flex align-items-center">
        <img src="{{ $item->produk->foto ? asset('storage/' . $item->produk->foto->path) : asset('assets/img/placeholder.png') }}" 
             alt="{{ $item->produk->nama_produk }}" 
             class="me-2" 
             style="width:40px; height:40px; border-radius:4px;">
        <span>{{ $item->produk->nama_produk }}</span>
    </div>
@else
    <span>Produk tidak tersedia</span>  <!-- Pesan alternatif jika produk tidak ada -->
@endif


                                            </td>
<td>
    @if($order->shipment) <!-- Check if shipment exists -->
        @switch($order->shipment->status)
            @case('delivered')
                <span class="badge bg-success">Delivered</span>
                @break
            @case('packed')
                <span class="badge bg-primary">Packed</span>
                @break
            @case('shipped')
                <span class="badge bg-warning">Shipped</span>
                @break
            @case('in_transit')
                <span class="badge bg-info">In Transit</span>
                @break
            @default
                <span class="badge bg-secondary">Unknown</span>
        @endswitch
    @else
        <span class="badge bg-secondary">No Shipment</span>
    @endif
    <br>
    <small class="text-muted">(status)</small>
</td>
                                            <td>
                                                {{ $order->order_no ?? '-' }} 🔗
                                            </td>
                                            <td>
                                                Rp. {{ number_format($order->total, 0, ',', '.') }} <!-- Display total as "Harga" -->
                                            </td>
                                        </tr>
                                    @endforeach
                                                                    @empty
                                    <tr>
                                        <td colspan="4">Tidak ada pesanan ditemukan.</td>
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