@extends('siswa.layouts.app')

@section('content')

<section class="content-card p-4 p-md-5">
<h1 class="fs-3 fw-bold text-dark mb-2">Laporan Progres</h1>
<p class="text-muted mb-4">Kirim Progres Project Yang Kamu Kerjakan Kepada Industri</p>

{{-- Notifikasi --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Form Unggah Progres --}}
<form action="{{ route('siswa.project-progress.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="p-4 bg-light rounded-4">
                <h5 class="fw-bold mb-3">Upload Progres</h5>
                <label for="pilih_project" class="form-label text-muted">Pilih Project</label>
                <select id="pilih_project" name="project_id" class="form-select custom-input mb-3" required>
                    <option value="" disabled selected>Pilih Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->nama_project }}</option>
                    @endforeach
                </select>

                <label for="progress_percent" class="form-label text-muted">Persentase Progres (%)</label>
                <input type="number" id="progress_percent" name="progress_percent" class="form-control custom-input mb-3" min="0" max="100" required>

                <label for="deskripsi_progres" class="form-label text-muted">Deskripsi Progres</label>
                <textarea id="deskripsi_progres" name="deskripsi_progres" class="form-control custom-input" rows="5"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 bg-light rounded-4 h-100 d-flex flex-column">
                <h5 class="fw-bold mb-3">Bukti Progres</h5>
                <div class="flex-grow-1 border border-dashed rounded-4 p-4 text-center d-flex flex-column justify-content-center align-items-center">
                    <i class="fa-solid fa-cloud-arrow-up text-muted fs-1 mb-2"></i>
                    <p class="mb-1 text-muted">Unggah dokumen untuk bukti pendukung</p>
                    <span id="file-name" class="text-secondary fw-semibold mb-2">Belum ada file dipilih</span>
                    <input type="file" id="file_upload" name="file_upload" class="d-none">
                    <label for="file_upload" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold mt-2">Pilih Dokumen</label>
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary custom-btn px-5 fw-bold">Unggah Progres</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Riwayat Laporan Progres --}}
<div class="p-4 bg-white rounded-4 shadow-sm">
    <h5 class="fw-bold mb-3">Riwayat Laporan Progres</h5>
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr class="text-muted">
                    <th>TANGGAL</th>
                    <th>PROJECT</th>
                    <th>PROGRES</th>
                    <th>STATUS</th>
                    <th>FEEDBACK</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($progressHistory as $progress)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($progress->tanggal)->format('d M Y') }}</div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($progress->tanggal)->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $progress->nama_project }}</div>
                            <small class="text-muted">{{ $progress->nama_perusahaan }}</small>
                        </td>
                        <td>
                            <div class="progress" role="progressbar" aria-valuenow="{{ $progress->progress_percent }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                <div class="progress-bar 
                                    @if($progress->progress_percent < 50) bg-danger
                                    @elseif($progress->progress_percent < 80) bg-warning
                                    @else bg-success
                                    @endif" 
                                    style="width: {{ $progress->progress_percent }}%;">
                                </div>
                            </div>
                            <small class="text-muted fw-semibold">{{ $progress->progress_percent }}%</small>
                        </td>
                       <td>
                            @switch($progress->status)
                                @case('draft')
                                    <span class="badge bg-secondary py-2 px-3 fw-semibold">Draft</span>
                                    @break

                                @case('pending')
                                    <span class="badge bg-warning text-dark py-2 px-3 fw-semibold">Pending</span>
                                    @break

                                @case('proses')
                                    <span class="badge bg-info py-2 px-3 fw-semibold">Proses</span>
                                    @break

                                @case('selesai')
                                    <span class="badge bg-success py-2 px-3 fw-semibold">Selesai</span>
                                    @break

                                @case('dibatalkan')
                                    <span class="badge bg-danger py-2 px-3 fw-semibold">Dibatalkan</span>
                                    @break

                                @default
                                    <span class="badge bg-light text-dark py-2 px-3 fw-semibold">-</span>
                            @endswitch
                        </td>

                        <td class="text-muted">
                            @if ($progress->feedback)
                                {{ $progress->feedback }}
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            @if ($progress->file_id)
                                <a href="{{ route('files.download', $progress->file_id) }}" class="btn btn-sm btn-outline-primary rounded-pill fw-semibold">
                                    Unduh File
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada laporan progres yang diunggah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</section>

<script>
document.getElementById('file_upload').addEventListener('change', function(e) {
const fileNameSpan = document.getElementById('file-name');
if (e.target.files.length > 0) {
fileNameSpan.textContent = e.target.files[0].name;
} else {
fileNameSpan.textContent = 'Belum ada file dipilih';
}
});
</script>

@endsection