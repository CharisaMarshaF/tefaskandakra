@extends('layouts.costumer.app')

@section('title', 'Kontak')

@section('content')
<h1 data-aos="fade-up" class="text-center mt-5">Hubungi Kami</h1>
    <p data-aos="fade-up" class="text-center">Silakan hubungi kami untuk pertanyaan, saran.</p>

    <!-- Hero Section -->
    <div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
        <div class="max-container">
            <div class="form-card">

                <div class="d-flex justify-content-center">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- FORM SECTION -->
                            <div class="col-lg-5">
                                <label class="form-label">Nama <strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control mb-3">

                                <label class="form-label">Kontak <strong style="color: red;">*</strong></label>
                                <input type="tel" class="form-control mb-3">

                                <label class="form-label">Subject <strong style="color: red;">*</strong></label>
                                <input type="text" class="form-control mb-3">

                                <label class="form-label">Pesan <strong style="color: red;">*</strong></label>
                                <textarea class="form-control mb-3" rows="8"></textarea>

                                <button class="btn-submit w-100">KIRIM PESAN</button>
                            </div>

                            <!-- IMAGE SECTION -->
                            <div class="col-lg-7 d-none d-lg-flex justify-content-center">
                                <div style="width: 100%; max-width: 600px;">
                                    <img src="{{ asset('img/kontak.jpeg') }}" alt="Kontak" class="img-fluid"
                                        style="aspect-ratio: 1 / 1; object-fit: contain; width: 90%; margin-left: 20px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection