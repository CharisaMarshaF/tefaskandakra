@extends('siswa.layouts.app')

@section('content')

<section class="content-card p-4 p-md-5">
<h1 class="fs-3 fw-bold text-dark mb-2">Lihat Nilai</h1>
<p class="text-muted mb-4">Lihat Hasil Nilai Yang Telah Kamu Kerjakan</p>

<div class="row g-4">
    <div class="col-md-8">
        <div class="p-4 bg-light rounded-4">
            <h5 class="fw-bold mb-4">Daftar Nilai</h5>
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Project</th>
                            <th>Nilai</th>
                            <th>Grade</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gradedProjects as $grade)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $grade->project->nama_project }}</div>
                            </td>
                            <td>
                                <div class="fw-bold fs-5 text-danger">{{ number_format($grade->nilai, 2) }}</div>
                                <small class="text-muted">Nilai Akhir</small>
                            </td>
                            <td><div class="fw-bold fs-5">{{ $grade->grade_huruf }}</div></td>
                            <td>
                                {{-- Tombol Lihat hanya jika ada file terkait (feedback atau sertifikat) --}}
                                {{-- Tombol Detail --}}
                                @if ($grade->feedback || $grade->sertifikat_file_id)
                                <button 
                                    class="btn btn-sm btn-outline-primary rounded-circle" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detailModal{{ $grade->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                @endif


                                {{-- Tombol Unduh untuk sertifikat --}}
                                @if ($grade->sertifikat_file_id)
                                <a href="{{ route('siswa.nilai_project.download', $grade->sertifikat_file_id) }}" class="btn btn-sm btn-outline-primary rounded-circle ms-2"><i class="fa-solid fa-download"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada proyek yang dinilai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="d-flex flex-column gap-3">
            <div class="info-card blue">
                <h3 class="fs-1 fw-bold mb-0">{{ $rataRataKeseluruhan }}</h3>
                <p class="mb-0 fw-semibold">Rata-rata Nilai</p>
                <small class="text-muted">Total dari semua proyek yang dinilai</small>
            </div>
            <div class="info-card green">
                <h3 class="fs-1 fw-bold mb-0">{{ $totalProjectsSelesai }}</h3>
                <p class="mb-0 fw-semibold">Proyek Selesai</p>
                <small class="text-muted">{{ $proyekBerjalan }} Proyek sedang berjalan</small>
            </div>
            <div class="info-card red">
                <h3 class="fs-1 fw-bold mb-0">{{ $gradeTertinggi }}</h3>
                <p class="mb-0 fw-semibold">Grade Tertinggi</p>
                <small class="text-muted">{{ $namaProjectTertinggi }}</small>
            </div>
        </div>
    </div>
</div>

</section>
@foreach ($gradedProjects as $grade)
<div class="modal fade" id="detailModal{{ $grade->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Detail Project: {{ $grade->project->nama_project }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <strong>Nama Project:</strong> {{ $grade->project->nama_project }}
        </div>
        <div class="mb-3">
          <strong>Perusahaan:</strong> {{ $grade->project->perusahaan->nama ?? '-' }}
        </div>
        <div class="mb-3">
          <strong>Nilai:</strong> {{ number_format($grade->nilai,2) }} ({{ $grade->grade_huruf }})
        </div>
        <div class="mb-3">
          <strong>Feedback:</strong> 
          <p class="text-muted">{{ $grade->feedback ?? 'Tidak ada feedback' }}</p>
        </div>
        <div class="mb-3">
          <strong>Status:</strong> 
          <span class="badge bg-{{ $grade->project->status == 'selesai' ? 'success' : 'info' }}">
            {{ ucfirst($grade->project->status) }}
          </span>
        </div>
        <div class="mb-3">
          <strong>Progress:</strong> {{ $grade->project->memberProgress->first()?->progress_percent ?? 0 }}%
        </div>
      </div>
      <div class="modal-footer">
        @if ($grade->sertifikat_file_id)
          <a href="{{ route('siswa.nilai_project.download', $grade->sertifikat_file_id) }}" class="btn btn-primary">
            <i class="fa-solid fa-download me-1"></i> Unduh Sertifikat
          </a>
        @endif
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection