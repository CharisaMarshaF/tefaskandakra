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

                    <form id="paymentForm" action="{{ route('customer.checkout.pay') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <p class="mb-2">Pilih Cara Bayar :</p>
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

                        <!-- DETAIL KARTU -->
                        <div id="card-details" class="mb-3" style="display: none;">
                            <label class="form-label">Nomor Kartu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="1234 5463 2342 3423">

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Kadaluwarsa <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="MM / YY">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVV <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="123">
                                </div>
                            </div>

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="simpan">
                                <label class="form-check-label" for="simpan">Simpan detail kartu</label>
                            </div>
                        </div>

                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <!-- Tombol Konfirmasi -->
                        <button type="button" id="openPinModal" class="btn btn-primary w-100 mt-4">
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

<!-- MODAL KONFIRMASI PIN -->
<div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <h5 class="fw-bold mb-3">Masukkan PIN Pembayaran</h5>
            <p class="text-muted">Masukkan PIN kartu 4 digit untuk konfirmasi pembayaran ini</p>

            <div class="pin-inputs mb-4">
                <input type="password" maxlength="1" class="form-control text-center">
                <input type="password" maxlength="1" class="form-control text-center">
                <input type="password" maxlength="1" class="form-control text-center">
                <input type="password" maxlength="1" class="form-control text-center">
            </div>

            <button class="btn btn-primary w-100 mb-2" id="confirmPayment">KONFIRMASI</button>
            <button class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">BATAL</button>
        </div>
    </div>
</div>

<!-- MODAL PEMBAYARAN SUKSES -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <h5 class="fw-bold mb-3">Terima kasih atas pembelian Anda</h5>
            <img src="{{ asset('img/modalsuccess.png') }}" alt="Ilustrasi" style="width: 80%; height: 80%;" class="img-fluid mb-3 d-block mx-auto">
            <p>
                Pesanan <a href="#" class="fw-bold text-primary" style="text-decoration: none;">#{{ $order->id }}</a> berhasil dikonfirmasi
            </p>
            <a href="{{ route('lacak.pesanan') }}"><button class="btn btn-primary w-100 mb-3">LACAK PESANAN</button></a>
            
            <button class="btn btn-outline-secondary w-100 fw-bold">
                <i class="fa fa-download"></i> Unduh Struk
            </button>
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
    // 🔹 Tampilkan input kartu hanya jika kartu kredit dipilih
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const cardDetails = document.getElementById('card-details');
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            cardDetails.style.display = (radio.value === 'kartu') ? 'block' : 'none';
        });
    });

    // 🔹 Inisialisasi modal Bootstrap
    const pinModal = new bootstrap.Modal(document.getElementById('pinModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // 🔹 Klik tombol konfirmasi -> buka modal PIN
    document.getElementById('openPinModal').addEventListener('click', () => {
        pinModal.show();
    });

    // 🔹 Pindah fokus otomatis antar PIN
    const pinInputs = document.querySelectorAll('.pin-inputs input');
    pinInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < pinInputs.length - 1) {
                pinInputs[index + 1].focus();
            }
        });
    });

    // 🔹 Validasi PIN dan submit form
    document.getElementById('confirmPayment').addEventListener('click', () => {
    const pin = Array.from(pinInputs).map(i => i.value).join('');
    if (pin.length < 4) {
        alert('Masukkan PIN 4 digit terlebih dahulu!');
        return;
    }

    const form = document.getElementById('paymentForm');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            pinModal.hide();         // tutup modal PIN
            successModal.show();     // tampilkan modal sukses
        } else {
            alert(data.message || 'Terjadi kesalahan!');
        }
    })
    .catch(error => console.error(error));
});

</script>
@endsection
