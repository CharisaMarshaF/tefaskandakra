@extends('layouts.siswa.App')

@section('contents')
    <h1 class="fs-3 fw-bold text-dark mb-2">Laporan Progres</h1>
    <p class="text-muted mb-4">Kirim Progres Project Yang Kamu Kerjakan Kepada Industri</p>
    
    <!-- Form Upload Progres -->
    <form action="{{ route('project-progress.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 mb-4">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="card shadow-lg p-4 bg-light rounded-4">
                    <h5 class="fw-bold mb-2">Upload Progres</h5>
                    <hr>
                    <div class="mb-3">
                        <label for="project_id" class="form-label text-muted">Pilih Project</label>
                        <select name="project_id" id="project_id" class="form-select custom-input" required>
                            <option value="" selected disabled>-- Pilih Project --</option>
                            @foreach ($project_progress as $prj)
                                <option value="{{ $prj->id }}">{{ $prj->nama_project }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label text-muted">Deskripsi Progres</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control custom-input" rows="5" placeholder="Ceritakan progres yang sudah kamu capai..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="progress_percent" class="form-label text-muted">Persentase Progres (%)</label>
                        <input type="number" name="progress_percent" id="progress_percent" class="form-control custom-input" placeholder="Masukkan persentase progres (0-100)" min="0" max="100" required>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="card shadow-lg p-4 bg-light rounded-4 h-100 d-flex flex-column">
                    <h5 class="fw-bold mb-3">Bukti Progres</h5>
                    <div class="flex-grow-1 border border-dashed rounded-4 p-4 text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-cloud-arrow-up text-muted fs-1 mb-2"></i>
                        <p class="mb-1 text-muted">Upload file bukti pendukung (pdf, jpg, png)</p>
                        <input type="file" name="file_bukti" class="form-control mt-3" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary custom-btn px-5 fw-bold">Unggah Progres</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Riwayat Laporan -->
    <div class="card shadow-lg p-4 bg-white rounded-4">
        <h5 class="fw-bold mb-4">Riwayat Laporan Progres</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="text-muted">
                    <tr>
                        <th style="width: 15%">TANGGAL</th>
                        <th style="width: 25%">PROJECT</th>
                        <th style="width: 25%">PROGRES</th>
                        <th style="width: 35%">DESKRIPSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($project_progress as $p)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ date('d M Y', strtotime($p->tanggal)) }}</div>
                                <small class="text-muted">{{ date('H:i', strtotime($p->tanggal)) }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $p->nama_project }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 10px; max-width: 200px;">
                                        <div 
                                            class="progress-bar bg-primary" 
                                            role="progressbar" 
                                            style="width: {{ $p->progress_percent }}%;" 
                                            aria-valuenow="{{ $p->progress_percent }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="fw-semibold text-muted" style="min-width: 40px;">{{ $p->progress_percent }}%</small>
                                </div>
                            </td>
                            <td>{{ $p->deskripsi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Belum ada laporan progres</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
