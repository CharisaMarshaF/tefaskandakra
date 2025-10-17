@extends('layouts.siswa.App')

@section('contents')
<h2 class="page-title">Dashboard Orang Tua / Wali Murid</h2>
<div class="container my-4">
    <!-- Card Info Murid -->
    <div class="card shadow-lg mb-4">
        <div class="card-body d-flex align-items-center">
            <div class="rounded-circle bg-secondary me-3" style="width:80px;height:80px;"></div>
            <div>
                <h5 class="mb-1 fw-bold">{{ $datasiswas->nama_lengkap ?? 'Nama Siswa' }}</h5>
                <p class="mb-0 text-muted">
                    Kelas: {{ $datasiswas->kelas->nama_kelas ?? '-' }} - 
                    NISN: {{ $datasiswas->nisn ?? '-' }} <br>
                    Angkatan: {{ $datasiswas->angkatan ?? '-' }}
                </p>
            </div>
        </div>
    </div>
    

    <div class="row g-3">
        <!-- Kolom kiri: Diagram -->
        <div class="col-md-6 d-flex flex-column">

            <div class="card progress-section shadow-lg">
                <h5 class="fw-bold">Pusat Informasi</h5>
                <h6 style="font-size: 12px; color: #6c757d; margin-bottom: 10px;">Monitoring Project & Dokumen TEFA</h6>
                
                <div class="chart-container">
                    <canvas id="progressChart"></canvas>
                </div>
                
                <div class="legend">
                   
                    <div class="legend-item">
                        <div class="legend-color green"></div>
                        <span>Project Selesai</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color red"></div>
                        <span>Surat Yang Belum Ditanda Tangan</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color blue"></div>
                        <span>Poject Yang Sedang Berjalan</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color orange"></div>
                        <span>Surat Yang Sudah Ditanda Tangan</span>
                    </div>
                    
                </div>
            </div>

            <!-- Card Mitra DUDI -->
            <div class="card shadow-lg p-3 mt-3">
                <h6 class="fw-bold mt-3 mb-4">MITRA DUDI — Teaching Factory</h6>
                <div class="d-flex justify-content-around align-items-center flex-wrap">
                    <a href="https://mdigi.tools/"><img src="/orangtua/mdigi.png" alt="EXP" style="height:90px;"></a>
                    <a href="https://www.instagram.com/expressa.group/"><img src="/orangtua/exp.png" alt="MSM Solo" class="mb-3" style="height:90px;"></a>
                </div>
            </div>
        </div>

        
    

        <!-- Kolom kanan: Project grades -->
        <div class="col-md-6">
            <div class="card shadow-lg mb-4">
                <h5 class="fw-bold mt-2 mb-3">Riwayat Project Selesai :</h5>

                @forelse($project_grades as $p)
                <div class="card shadow-lg mb-4 border-0 " style="background-color:#c7f0c6;">
                  <div class="card-body p-2">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-bold">{{ $p->nama_project }}</h6>
                      <span class="badge bg-success">Selesai</span>
                    </div>
                    <p class="mb-0 small">Klien: {{ $p->deskripsi }}</p>
                    <p class="text-muted small fst-italic">
                      Periode: {{ $p->start_date }} - {{ $p->deadline }}
                    </p>
              
                    <div class="row">
                      <div class="col-md-8">
                        <p class="mb-1 small fw-bold">Nilai: {{ number_format($p->nilai, 2) }}</p>
                      </div>
                      <div class="col-md-4 text-md-end">
                        <p class="small text-muted mb-0">
                          Diselesaikan {{ \Carbon\Carbon::parse($p->graded_at)->format('d M Y') }}
                        </p>
                      </div>
                    </div>
              
                    <div class="card border-0 shadow-sm p-3 mb-3">
                      <p class="mb-0 fst-italic small">
                        <strong>Feedback Guru:</strong><br>
                        "{{ $p->feedback }}"
                      </p>
                    </div>
                  </div>
                </div>
                @empty
                <p class="text-muted">Belum ada project yang selesai.</p>
                @endforelse
                <div class="d-flex align-items-center text-center my-4">
                  <div class="flex-grow-1 border-top"></div>
                  <a href="/riwayat" class="btn btn-primary mx-3 fw-semibold shadow-sm">
                      Lihat Semua
                  </a>
                  <div class="flex-grow-1 border-top"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
