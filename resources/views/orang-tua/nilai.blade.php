@extends('layouts.siswa.App')

@section('contents')
<h2 class="page-title">Nilai & Progres</h2>

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
    <!-- Kolom kiri: Nilai Siswa -->
    <div class="col-md-7">
      <div class="card shadow-lg h-100">
        <div class="card-body">
          <h5 class="fw-bold mb-3 text-center ">Nilai Siswa</h5>
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th class=" text-center text-primary">Nama Project</th>
                  <th class=" text-center text-primary">Tanggal</th>
                  <th class=" text-center text-primary">Feedback</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($project_grades as $index => $progress)
                  <tr>
                    <td class="fw-semibold">{{ $progress->nama_project }}</td>
                    <td>{{ $progress->start_date }} - {{ $progress->deadline }}</td>
                    <td>{{ $sertifikats[$index]->feedback ?? 'Belum ada feedback' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data project.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Kolom kanan: Sertifikat -->
    <div class="col-md-5">
      <div class="card shadow-lg h-100">
        <div class="card-body">
          <h5 class="fw-bold mb-3 text-center">Sertifikat</h5>
          <div class="table-responsive" style="max-height: 400px; overflow-y:auto;">
            <table class="table align-middle">
              <tbody>
                @forelse($sertifikats as $sertifikat)
                  <tr>
                    <td>
                      <span class="d-inline-block rounded-circle bg-primary" style="width: 12px; height: 12px;"></span>
                    </td>
                    <td class="fw-semibold">{{ $sertifikat->nama_sertifikat }}</td>
                    <td class="text-end">
                      <a href="{{ route('download.sertifikat', $sertifikat->id) }}" class="btn btn-light border me-1">
                        <i class="bi bi-download text-primary"></i>
                      </a>
                      <button type="button" class="btn btn-light border" 
                              data-bs-toggle="modal" 
                              data-bs-target="#sertifikatModal"
                              data-title="{{ $sertifikat->nama_sertifikat }}"
                              data-file="{{ asset('storage/sertifikat/'.$sertifikat->nama_sertifikat) }}">
                        <i class="bi bi-eye text-primary"></i>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="3" class="text-center text-muted">Belum ada sertifikat.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bagian bawah: Progres Project -->
  <div class="row mt-4">


   <div class="card shadow-lg mb-4">
    <div class="col-12">
      <h5 class="fw-bold mb-3">Project yang sedang dikerjakan:</h5>

      @forelse($project_progress as $progress)
        <div class="card shadow-lg mb-3" style="background-color: #e6f7ff;">
          <div class="card-body">
            <!-- Judul + Status -->
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold">{{ $progress->nama_project ?? 'Nama Project' }}</h6>
              <span class="badge bg-primary px-3 py-2">Sedang Berjalan</span>
            </div>

            <!-- Progress Bar -->
            <p class="mb-1">Progres</p>
            <div class="progress" style="height: 10px;">
              <div class="progress-bar bg-primary" role="progressbar" 
                   style="width: {{ $progress->progress_percent }}%" 
                   aria-valuenow="{{ $progress->progress_percent }}" 
                   aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between text-muted small mt-1">
              <span>0%</span>
              <span>50%</span>
              <span>100%</span>
            </div>

            <!-- Deadline & Keterangan -->
           
            <h6 class="text-muted small">
              {{ $progress->deskripsi ?? '' }}
            </h6>
            <p class="text-muted small mt-2 mb-0">
              Tanggal : {{ $progress->tanggal?? '-' }}
            </p>
          </div>
        </div>
      @empty
        <p class="text-muted">Belum ada project yang berjalan.</p>
      @endforelse

    </div>

   </div>
    
  </div>
</div>

<!-- Modal Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sertifikatModalLabel">Detail Sertifikat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <iframe id="sertifikatFrame" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var sertifikatModal = document.getElementById('sertifikatModal');
  sertifikatModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var title = button.getAttribute('data-title');
    var file = button.getAttribute('data-file');

    sertifikatModal.querySelector('.modal-title').textContent = title;
    sertifikatModal.querySelector('#sertifikatFrame').src = file;
  });
});
</script>
@endsection
