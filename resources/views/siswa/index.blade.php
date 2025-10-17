@extends('layouts.siswa.App')

@section('contents')
<div class="hero-banner mb-4">
    <h1 class="fs-2 fw-bold mb-3">
        Selamat Datang di TEFA SMKN 2 KARANGANYAR, {{ Auth::user()->username }} !
    </h1>
    <p class="mb-4">Dengan sistem informasi TEFA Membangun Generasi Bangsa Yang Maju.</p>
    <a href="/lihatnilai" class="btn btn-outline-light rounded-pill px-4 fw-semibold">Lihat nilai</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle me-3"><i class="fa-solid fa-building fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Kelas Industri</p>
                <h4 class="fw-bold mb-0">3</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle green me-3"><i class="fa-solid fa-clipboard-list fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Project Sedang Berjalan</p>
                <h4 class="fw-bold mb-0">{{ $project_progress->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-card d-flex align-items-center">
            <div class="icon-circle red me-3"><i class="fa-solid fa-chart-bar fs-5"></i></div>
            <div>
                <p class="mb-0 text-muted">Rata-rata Nilai</p>
                <h4 class="fw-bold mb-0">{{ number_format($project_grades->avg('nilai'), 1) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card p-4">
            <h5 class="fw-bold mb-3">Project Yang Sedang Berjalan :</h5>

            <div class="col-12">
                @forelse($project_progress as $progress)
                    <div class="card shadow-lg mb-3" style="background-color: #e6f7ff;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold">{{ $progress->nama_project ?? 'Nama Project' }}</h6>
                                <span class="badge bg-primary px-3 py-2">Sedang Berjalan</span>
                            </div>

                            <p class="mb-1">Progres</p>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $progress->progress_percent }}%"
                                    aria-valuenow="{{ $progress->progress_percent }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between text-muted small mt-1">
                                <span>0%</span>
                                <span>50%</span>
                                <span>100%</span>
                            </div>

                            <h6 class="text-muted small mt-2">
                                {{ $progress->deskripsi ?? '' }}
                            </h6>
                            <p class="text-muted small mt-2 mb-0">
                                Tanggal : {{ $progress->tanggal ?? '-' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada project yang berjalan.</p>
                @endforelse
            </div>

            {{-- Tombol "Lihat Semua" di tengah --}}
            <div class="text-center mt-4">
                <a href="/produksi" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                    <i class="fa-solid fa-list me-2"></i> Lihat Semua
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="p-4 bg-white border rounded-4 shadow-sm">
            <h4 class="fw-bold mb-3 text-dark">Jadwal Produksi Hari Ini</h4>
            <p class="text-muted mb-4">
                <i class="fa-solid fa-calendar-days me-2 text-primary"></i>
                {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') . ' (Hari Ini)' }}
            </p>

            @forelse($jadwal_project as $jadwal)
                <div class="bg-primary-subtle p-3 rounded-3 d-flex align-items-center shadow-sm border border-primary-subtle mb-3">
                    <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-code fs-5"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-semibold text-dark">{{ $jadwal->nama_project }}</p>
                        <small class="text-muted d-block">{{ $jadwal->nama_kelas }}</small>
                        <div class="d-flex align-items-center mt-1">
                            <i class="fa-solid fa-clock text-muted me-1"></i>
                            <small class="text-muted">{{ $jadwal->jam_mulai }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info mb-0">Tidak ada jadwal hari ini.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
