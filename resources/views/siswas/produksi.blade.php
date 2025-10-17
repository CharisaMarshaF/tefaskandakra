@extends('layouts.siswa.App')

@section('contents')
<div class="container-fluid">
    <h1 class="fs-3 fw-bold text-dark mb-2">Produksi TEFA</h1>
    <p class="text-muted mb-4">Pilih kelas industri terbaikmu untuk mewujudkan kemajuan pemikiran</p>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4 col-sm-12">
            <div class="p-4 bg-primary-subtle border border-primary-subtle rounded-4 d-flex align-items-center justify-content-between shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-users fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold text-dark">Project Aktif</h6>
                        <small class="text-muted">Sedang Berjalan</small>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-0">{{ $project_progress->count() }}</h2>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="p-4 bg-success-subtle border border-success-subtle rounded-4 d-flex align-items-center justify-content-between shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-play-circle fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold text-dark">Selesai</h6>
                        <small class="text-muted">Sudah dinilai</small>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-0">{{ $project_grades->count() }}</h2>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="p-4 bg-danger-subtle border border-danger-subtle rounded-4 d-flex align-items-center justify-content-between shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-check-circle fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold text-dark">Total Project</h6>
                        <small class="text-muted">Keseluruhan project aktif dan selesai</small>
                    </div>
                </div>
                <h2 class="fw-bold text-dark mb-0">{{ $project_grades->count() + $project_progress->count() }}</h2>
            </div>
        </div>
    </div>

    {{-- Project --}}
    <div class="row g-4">
        <div class="col-lg-8 col-md-12">
            
            

            {{-- Card Project 2 --}}
            @forelse($project_progress as $progress)
            <div class="card shadow-sm mb-3" style="background-color: #e6f7ff;">
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

        {{-- Jadwal --}}
        <div class="col-lg-4 col-md-12">
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
</div>
@endsection
