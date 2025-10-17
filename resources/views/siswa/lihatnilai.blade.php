@extends('layouts.siswa.App')

@section('contents')
    <h1 class="fs-3 fw-bold text-dark mb-2">Lihat Nilai</h1>
    <p class="text-muted mb-4">Lihat Hasil Nilai Yang Telah Kamu Kerjakan</p>

    <div class="row g-4">
        {{-- Kolom Tabel Nilai --}}
        <div class="col-lg-8 col-md-12">
            <div class="card shadow-lg h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-center">Nilai Siswa</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted">
                                    <th class="py-3">Project</th>
                                    <th class="py-3">Feedback</th>
                                    <th class="py-3 ">Nilai</th>
                                    <th class="py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($project_grades as $g)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold py-3">{{ $g->nama_project }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $g->feedback }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold fs-5 text-danger">{{ number_format($g->nilai, 1) }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Card Nilai --}}
        <div class="col-lg-4 col-md-12">
            <div class="d-flex flex-column gap-4">
                <div class=" card shadow-sm p-4 rounded text-danger bg-danger bg-opacity-25 ">
                    <h3 class="fs-1 fw-bold mb-0 text-center">{{ number_format($project_grades->max('nilai'), 1) }}</h3>
                    <p class="mb-0 fw-semibold text-center">Nilai Tertinggi</p>
                </div>
                <div class=" card shadow-sm p-4 rounded text-primary bg-primary bg-opacity-25 ">
                    <h3 class="fs-1 fw-bold mb-0 text-center">{{ number_format($project_grades->avg('nilai'), 1) }}</h3>
                    <p class="mb-0 fw-semibold text-center">Rata-rata Nilai</p>
                </div>
                <div class=" card shadow-sm p-4 rounded text-success bg-success bg-opacity-25">
                    <h3 class="fs-1 fw-bold mb-0 text-center">{{ $project_grades->count() }}</h3>
                    <p class="mb-0 fw-semibold text-center">Project Selesai</p>
                </div>
            </div>
        </div>
    </div>
@endsection
