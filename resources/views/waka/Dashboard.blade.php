@extends('layouts.Waka.Waka.Waka')
@section('content')
    <div class="content-card p-4 p-md-5">
        <h1 class="fs-3 fw-bold text-dark mb-1">Dashboard Waka Kurikulum</h1>
        <p class="text-muted mb-4">WAKA Kurikulum - Kelola Jadwal Kelas Industri</p>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="info-card d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-code fa-2x text-muted"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Jumlah Kelas Industri</h6>
                        <p class="fs-3 fw-bold mb-0 text-dark">4</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-card d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-users fa-2x" style="color: #17e335;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Siswa Kelas Industri</h6>
                        <p class="fs-3 fw-bold mb-0 text-dark">432</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-card d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-clipboard-check fa-2x" style="color: #4168e3;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Outcome</h6>
                        <p class="fs-3 fw-bold mb-0 text-dark">89</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-card d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-handshake-angle fa-2x" style="color: #ff9800;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Mitra Industri</h6>
                        <p class="fs-3 fw-bold mb-0 text-dark">12</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <h5 class="fw-bold mb-4">MITRA DUDI - Teaching Factory</h5>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 align-items-center justify-content-center">
                <div class="col text-center mitra-logo">
                    <img src="{{ asset('img/landing_page/logo-expressa 1.png') }}" alt="EXP Logo" class="img-fluid">
                </div>
                <div class="col text-center mitra-logo">
                    <img src="{{ asset('img/landing_page/logo-msm 1.png') }}" alt="MSM Solo Logo" class="img-fluid">
                </div>
                <div class="col text-center mitra-logo">
                    <img src="{{ asset('img/landing_page/NASMOCO 1.png') }}" alt="Nasmaco Logo" class="img-fluid">
                </div>
                <div class="col text-center mitra-logo">
                    <img src="{{ asset('img/landing_page/mdigi.png') }}" alt="EXP Logo" class="img-fluid">
                </div>
                <div class="col text-center mitra-logo">
                    <img src="{{ asset('img/landing_page/logo-msm 1.png') }}" alt="MSM Solo Logo" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4">Jumlah Kelas Industri</h5>
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                        <div class="chart-placeholder flex-shrink-0 mb-3 mb-md-0">
                            <i class="fa-solid fa-chart-pie fa-3x text-muted"></i>
                        </div>
                        <div class="ms-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle me-2"
                                        style="width: 12px; height: 12px; background-color: #4168e3;"></div>
                                    Mesin<span class="ms-auto fw-bold">16 Kelas</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle me-2"
                                        style="width: 12px; height: 12px; background-color: #17e335;"></div>
                                    RPL<span class="ms-auto fw-bold">12 Kelas</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle me-2"
                                        style="width: 12px; height: 12px; background-color: #ff9800;"></div>
                                    Tekstil<span class="ms-auto fw-bold">9 Kelas</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle me-2"
                                        style="width: 12px; height: 12px; background-color: #e31717;"></div>
                                    Otomotif<span class="ms-auto fw-bold">10 Kelas</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4">Jumlah Siswa</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-medium">Mesin</small>
                                <small class="text-muted">432 dari 500</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-siswa" role="progressbar" style="width: 86.4%;"
                                    aria-valuenow="432" aria-valuemin="0" aria-valuemax="500"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-medium">Mesin</small>
                                <small class="text-muted">432 siswa</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-siswa" role="progressbar" style="width: 86.4%;"
                                    aria-valuenow="432" aria-valuemin="0" aria-valuemax="500"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-medium">RPL</small>
                                <small class="text-muted">432 siswa</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-siswa" role="progressbar" style="width: 86.4%;"
                                    aria-valuenow="432" aria-valuemin="0" aria-valuemax="500"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-medium">Otomotif</small>
                                <small class="text-muted">432 siswa</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-siswa" role="progressbar" style="width: 86.4%;"
                                    aria-valuenow="432" aria-valuemin="0" aria-valuemax="500"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
