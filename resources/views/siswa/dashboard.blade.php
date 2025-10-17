{{-- 
@section('content')
<div class="container">
    <h2>Selamat Datang di TEFA SMKN 2 KARANGANYAR, {{ $siswa->nama_lengkap }}!</h2>
    <p>Dengan sistem informasi TEFA Membangun Generasi Bangsa Yang Maju.</p>

    <div class="row text-center my-4">
        <div class="col">
            <h4>Kelas Industri</h4>
            <p>{{ $totalKelasIndustri }}</p>
        </div>
        <div class="col">
            <h4>Project Aktif</h4>
            <p>{{ $totalProjectAktif }}</p>
        </div>
        <div class="col">
            <h4>Progress Rata-rata</h4>
            <p>{{ $progressRataRata }}%</p>
        </div>
    </div>

    <h3>Projek Aktif</h3>
    <ul class="list-group mb-4">
        @forelse($projects as $project)
            <li class="list-group-item">
                <strong>{{ $project->nama_project }}</strong> - Progress: {{ $project->progress }}%
            </li>
        @empty
            <li class="list-group-item">Belum ada project aktif.</li>
        @endforelse
    </ul>

    <h3>Jadwal Produksi Hari Ini</h3>
    <ul class="list-group">
        @forelse($jadwalHariIni as $jadwal)
            <li class="list-group-item">
                {{ $jadwal->nama_project }} ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
            </li>
        @empty
            <li class="list-group-item">Tidak ada jadwal produksi hari ini.</li>
        @endforelse
    </ul>
</div> --}}

@extends('siswa.layouts.app')

@section('content')
<div class="hero-banner mb-4">
    <h1 class="fs-2 fw-bold mb-3">Selamat Datang di TEFA SMKN 2 KARANGANYAR, {{ $siswa->nama_lengkap }}!</h1>
    <p class="mb-4">Dengan sistem informasi TEFA Membangun Generasi Bangsa Yang Maju.</p>
    <button class="btn btn-outline-light rounded-pill px-4 fw-semibold">Lihat nilai</button>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle me-3"><i class="fa-solid fa-building fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Kelas Industri</p>
                <h4 class="fw-bold mb-0">{{ $totalKelasIndustri }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle green me-3"><i class="fa-solid fa-clipboard-list fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Project Aktif</p>
                <h4 class="fw-bold mb-0">{{ $totalProjectAktif }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle red me-3"><i class="fa-solid fa-chart-bar fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Progress Rata-rata</p>
                <h4 class="fw-bold mb-0">{{ $progressRataRata }}%</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card p-4">
            <h5 class="fw-bold mb-3">Projek Aktif</h5>
            <div class="list-group list-group-flush">
                @forelse($projects as $project)
                    <div class="list-group-item bg-transparent border-0 d-flex align-items-center py-3">
                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">{{ $project->nama_project }}</h6>
                            <small class="text-muted">Proyek Aktif</small>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100" style="height: 8px;">
                                <div class="progress-bar progress-bar-primary" style="width: {{ $project->progress }}%"></div>
                            </div>
                            <small class="text-muted fw-semibold">{{ $project->progress }}%</small>
                        </div>
                        <span class="badge bg-primary text-white status-badge ms-auto">Aktif</span>
                    </div>
                @empty
                    <div class="list-group-item bg-transparent border-0 py-3 text-center">
                        <p class="text-muted mb-0">Belum ada project aktif.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
<div class="col-lg-4">
    <div class="content-card p-4">
        <h5 class="fw-bold mb-3">Jadwal Produksi Hari Ini</h5>
        <p class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>

        @forelse($jadwalHariIni as $jadwal)
            <div class="card p-3 bg-light rounded-4 border-0 mb-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-4 p-3 me-3" style="background-color: #e0e7ff; color: #5541d4;">
                        <i class="fa-solid fa-code fs-4"></i>
                    </div>
                    <div>
                        <p class="fw-semibold mb-0">{{ $jadwal->nama_project }}</p>
                        <div class="d-flex align-items-center mt-1">
                            <i class="fa-solid fa-clock text-muted me-1"></i>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card p-3 bg-light rounded-4 border-0 text-center">
                <p class="text-muted mb-0">Tidak ada jadwal produksi hari ini.</p>
            </div>
        @endforelse
    </div>
</div>

</div>
@endsection
