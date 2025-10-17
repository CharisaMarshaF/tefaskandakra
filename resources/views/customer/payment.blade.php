@extends('layouts.costumer.app')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="row g-4">

            <!-- FORM PEMBAYARAN -->
            <div class="col-lg-6">
                <div class="form-card">
                    <h5 class="fw-bold mb-3">Metode Pembayaran</h5>

                    <!-- Menampilkan Error Global -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="paymentForm" action="{{ route('customer.checkout.pay') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <!-- User Data Section -->
                        <div class="mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->username) }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="2" required>{{ old('alamat_lengkap', $user->alamat_lengkap ?? '') }}</textarea>
                            @error('alamat_lengkap')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $user->phone ?? '') }}" required>
                            @error('telepon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method Section -->
                        <div class="mb-3">
                            <label class="form-label">Pilih Cara Bayar <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="kartu" value="kartu" required>
                                    <label class="form-check-label" for="kartu">Kartu Kredit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="va" value="va">
                                    <label class="form-check-label" for="va">Virtual Account</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="manual" value="manual">
                                    <label class="form-check-label" for="manual">Transfer Manual</label>
                                </div>
                            </div>
                            @error('payment_method')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transfer Receipt Upload Section (Hidden by default) -->
                        <div id="transferReceiptSection" class="mb-3" style="display: none;">
                            <label class="form-label">Upload Bukti Transfer</label>
                            <input type="file" name="receipt_image" class="form-control" accept="image/*">
                            @error('receipt_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmation Button -->
                        <button type="submit" class="btn-submit w-100 mt-4">
                            Konfirmasi Pembayaran Rp. {{ number_format($total, 0, ',', '.') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- RINGKASAN PESANAN -->
            <div class="col-lg-6">
                <div class="form-card">
                    <h5 class="fw-bold mb-3">Ringkasan Pemesanan</h5>

                    <div class="order-header d-flex justify-content-between">
                        <span>PRODUK</span>
                        <span>SUB TOTAL</span>
                    </div>
                    <hr>

                    @foreach ($items as $item)
                        <div class="order-item d-flex align-items-center mb-2">
                            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('assets/img/placeholder.png') }}"
                                alt="{{ $item->nama_produk }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 12px;">
                            <div class="ms-2">
                                <div>{{ $item->nama_produk }}</div>
                                <small>x {{ $item->qty }}</small>
                            </div>
                            <div class="ms-auto">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endforeach

                    <hr>
                    <div class="total d-flex justify-content-between fw-bold">
                        <span>Harga Total</span>
                        <span style="color: #050C9C;">Rp. {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pin-inputs {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin: 20px 0;
    }
    .pin-inputs input {
        width: 60px;
        height: 60px;
        text-align: center;
        font-size: 22px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: 0.2s;
    }
    .pin-inputs input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
    }
    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 🔹 Show the receipt upload section for all payment methods
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const transferReceiptSection = document.getElementById('transferReceiptSection'); // The receipt upload section

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            // The receipt upload section is shown for all payment methods now
            transferReceiptSection.style.display = 'block'; // Show receipt upload
        });
    });

    // 🔹 Optional validation for image upload (if required)
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const receiptImage = document.querySelector('input[name="receipt_image"]').files[0];

        // Validation: If the payment method is "manual" and no receipt image is uploaded, show an alert
        if (paymentMethod === 'manual' && !receiptImage) {
            alert('Harap upload bukti transfer.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

@endsection
