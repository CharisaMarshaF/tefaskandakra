@extends('layouts.siswa.App')


@section('contents')
<h2 class="page-title">Riwayat Project</h2>



<div class="container my-4">
  
<!-- Card Info Murid -->
<div class="card shadow-lg mb-4 mt-4">
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
  {{-- =============== PROJECT SELESAI =============== --}}
    @forelse($project_grades as $p)
    <div class="card shadow-lg mb-4 border-0" style="background-color:#c7f0c6;">
      <div class="card-body">
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

        <div class="d-flex gap-2">
        

          {{-- Tombol Lihat -> buka modal --}}
          <button class="btn btn-warning"
            data-bs-toggle="modal"
            data-bs-target="#detailModal"
            data-nama="{{ $p->nama_project }}"
            data-klien="{{ $p->deskripsi }}"
            data-periode="{{ $p->start_date }} - {{ $p->deadline }}"
            data-nilai="{{ number_format($p->nilai, 2) }}"
            data-feedback="{{ $p->feedback }}"
            data-graded="{{ \Carbon\Carbon::parse($p->graded_at)->format('d M Y') }}">
            <i class="bi bi-eye"></i>
          </button>
        </div>
      </div>
    </div>
    @empty
    <p class="text-muted">Belum ada project yang selesai.</p>
    @endforelse

  
</div>

{{-- Modal Detail Project --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="detailNama"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="small mb-1"><strong>Klien:</strong> <span id="detailKlien"></span></p>
        <p class="small mb-1"><strong>Periode:</strong> <span id="detailPeriode"></span></p>
        <p class="small mb-1"><strong>Tanggal Selesai:</strong> <span id="detailGraded"></span></p>
        <p class="mb-2"><strong>Nilai:</strong> <span id="detailNilai"></span></p>

        <div class="alert alert-light border">
          <strong>Feedback:</strong>
          <p class="mb-0 fst-italic" id="detailFeedback"></p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script untuk isi modal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  var modal = document.getElementById('detailModal');
  modal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    document.getElementById('detailNama').textContent = button.getAttribute('data-nama');
    document.getElementById('detailKlien').textContent = button.getAttribute('data-klien');
    document.getElementById('detailPeriode').textContent = button.getAttribute('data-periode');
    document.getElementById('detailNilai').textContent = button.getAttribute('data-nilai');
    document.getElementById('detailFeedback').textContent = button.getAttribute('data-feedback');
    document.getElementById('detailGraded').textContent = button.getAttribute('data-graded');
  });
});
</script>
@endsection
