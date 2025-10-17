{{-- @extends('siswa.layouts.bootstrap')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-2">Produksi TEFA</h2>
    <p class="text-muted">Pilih kelas industri terbaikmu untuk mewujudkan kemajuan pemikiran</p>

    <!-- Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Project</h6>
                    <p class="fs-3 fw-bold mb-0">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted">Project Aktif</h6>
                    <p class="fs-3 fw-bold text-primary mb-0">{{ $activeProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted">Selesai</h6>
                    <p class="fs-3 fw-bold text-success mb-0">{{ $completedProjects }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Daftar project -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                    <span class="fw-bold">Daftar Project</span>
                </div>
                <div class="mb-3">
    <form method="GET" action="{{ route('siswa.projects') }}" class="row g-2">
        <div class="col-auto">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="proses" {{ $filterStatus=='proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $filterStatus=='selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        @if($filterStatus)
            <div class="col-auto">
                <a href="{{ route('siswa.projects') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        @endif
    </form>
</div>

                <div class="card-body">
                    @foreach($projects as $project)
                    <div class="p-3 mb-3 border rounded shadow-sm bg-light">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5>{{ $project->nama_project }}</h5>
                                <small>Perusahaan: {{ $project->perusahaan_nama }}</small><br>
                                <small>Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</small>
                                <div class="mt-1 progress" style="height:6px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $project->progress_value }}%;"></div>
                                </div>
                                <small>{{ $project->progress_value }}% progress</small>
                            </div>
                            <div>
                                <span class="badge @if($project->status=='proses') bg-primary @elseif($project->status=='selesai') bg-success @else bg-danger @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                                <button class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $project->nama_project }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Deskripsi:</strong> {{ $project->deskripsi }}</p>
                                    <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</p>
                                    <p><strong>Progress:</strong> {{ $project->progress_value }}%</p>

                                    @if($project->status == 'selesai')
                                        <p><strong>Nilai:</strong> {{ $project->grade ?? '-' }}</p>
                                        <p><strong>Feedback:</strong> {{ $project->feedback ?? '-' }}</p>
                                        @if($project->sertifikat_file)
                                            <a href="{{ route('files.download', $project->sertifikat_file->id) }}" class="btn btn-success btn-sm">
                                                Download Sertifikat
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if($projects->isEmpty())
                        <p class="text-center text-muted">Belum ada project yang diikuti.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Jadwal Produksi Hari Ini -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 fw-bold">
                    Jadwal Produksi Hari Ini
                </div>
                <div class="card-body">
                    @forelse($todaySchedules as $schedule)
                        <div class="p-3 mb-3 border rounded bg-light shadow-sm">
                            <h6 class="mb-1">{{ $schedule->project->nama_project }}</h6>
                            <small class="d-block text-muted">{{ $schedule->project->perusahaan->nama ?? '-' }}</small>
                            <small class="fw-bold">
                                {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                            </small>
                        </div>
                    @empty
                        <p class="text-center text-muted">Tidak ada jadwal hari ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('siswa.layouts.app')

@section('content')
<style>
    /* Custom styling for badges and buttons */
    .status-badge.aktif {
        background-color: #d1e7dd; /* Success sublte */
        color: #0f5132; /* Success */
    }
    .status-badge.selesai {
        background-color: #f8d7da; /* Danger sublte */
        color: #842029; /* Danger */
    }
    .custom-btn {
        background-color: #0d6efd; /* Primary */
        color: #fff;
    }
    .custom-btn:hover {
        background-color: #0b5ed7;
        color: #fff;
    }
    /* Simple styling for cards and icons */
    .p-4.bg-light.rounded-4 {
        border: 1px solid #e9ecef;
    }
</style>
<section class="content-card p-4 p-md-5">
    <h1 class="fs-3 fw-bold text-dark mb-4">Produksi TEFA</h1>
    <p class="text-muted mb-4">Pilih kelas Industri Terbaikmu, Untuk Mewujudkan Kemajuan Pemikiran</p>

    <!-- Statistik Card Section -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="p-4 bg-light rounded-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-subtle rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-users text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold">Total Project</h5>
                    </div>
                </div>
                <h2 class="fw-bold mb-0">{{ $totalProjects }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-light rounded-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-success-subtle rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-play-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold">Project Aktif</h5>
                    </div>
                </div>
                <h2 class="fw-bold mb-0">{{ $activeProjects }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-light rounded-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-danger-subtle rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-check-circle text-danger fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold">Selesai</h5>
                    </div>
                </div>
                <h2 class="fw-bold mb-0">{{ $completedProjects }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Project List Section -->
        <div class="col-md-8">
            <div class="p-4 bg-light rounded-4">
                <h4 class="fw-bold mb-3">Daftar Project</h4>
                <!-- Filter Form -->
                <div class="mb-3">
                    <form method="GET" action="{{ route('siswa.projects') }}" class="row g-2">
                        <div class="col-auto">
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">-- Semua Status --</option>
                                <option value="proses" {{ $filterStatus == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $filterStatus == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        @if($filterStatus)
                            <div class="col-auto">
                                <a href="{{ route('siswa.projects') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                            </div>
                        @endif
                    </form>
                </div>
                <!-- Project Loop -->
                @forelse($projects as $project)
                    <div class="p-4 bg-light rounded-4 mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">{{ $project->nama_project }}</h4>
                            <span class="badge status-badge {{ $project->status == 'proses' ? 'aktif' : 'selesai' }} py-2 px-3">{{ ucfirst($project->status) }}</span>
                        </div>
                        <p class="mb-1 text-muted">{{ $project->deskripsi }}</p>
                        <p class="mb-3 text-muted">{{ $project->perusahaan->nama ?? 'N/A' }}</p>
                        
                        <a href="#" class="btn btn-primary btn-sm rounded-pill fw-semibold custom-btn" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">Lihat Detail</a>
                    </div>
                    
                    <!-- Modal Detail -->
                    <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $project->nama_project }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Deskripsi:</strong> {{ $project->deskripsi }}</p>
                                    <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</p>
                                    <p><strong>Progress:</strong> {{ $project->progress_value }}%</p>
                                    
                                    @if($project->status == 'selesai')
                                        <p><strong>Nilai:</strong> {{ $project->grade ?? '-' }}</p>
                                        <p><strong>Feedback:</strong> {{ $project->feedback ?? '-' }}</p>
                                        @if($project->sertifikat_file)
                                            <a href="{{ route('files.download', $project->sertifikat_file->id) }}" class="btn btn-success btn-sm">
                                                Download Sertifikat
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Belum ada project yang diikuti.</p>
                @endforelse
            </div>
        </div>

        <!-- Today's Schedule Section -->
        <div class="col-md-4">
            <div class="p-4 bg-light rounded-4">
                <h4 class="fw-bold mb-3">Jadwal Produksi Hari Ini</h4>
                <p class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                
                @forelse($todaySchedules as $schedule)
                    <div class="bg-white p-3 rounded-3 d-flex align-items-center shadow-sm mb-3">
                        <div class="bg-primary rounded-circle p-2 me-3">
                            <i class="fa-solid fa-code text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold">{{ $schedule->project->nama_project }}</p>
                            <small class="text-muted">{{ $schedule->project->perusahaan->nama ?? '-' }}</small>
                            <div class="d-flex align-items-center mt-1">
                                <i class="fa-solid fa-clock text-muted me-1"></i>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Tidak ada jadwal hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
