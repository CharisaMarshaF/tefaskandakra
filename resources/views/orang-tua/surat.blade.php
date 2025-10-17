@extends('layouts.siswa.App')

@section('contents')
<h2 class="fw-bold">Surat Pernyataan</h2>
<p>Lihat dan Setujui surat pernyataan</p>

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

<!-- Surat Terbaru -->
<div class="card shadow-lg mb-4">
  <div class="card-body">
    <h5 class="fw-semibold mb-3 text-center">Surat Terbaru</h5>

    @if($dataSurat->isEmpty())
      <p class="text-center text-muted">Tidak ada surat terbaru</p>
    @else
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th class="text-primary">Nama Surat</th>
            <th class="text-primary">Jenis Surat</th>
            <th class="text-primary">Status</th>
            <th class="text-primary text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataSurat as $s)
            <tr>
              <td>{{ $s->nama_file }}</td>
              <td class="text-capitalize">{{ $s->file_type }}</td>
              <td><span class="badge bg-danger">Belum disetujui</span></td>
              <td class="text-center">
                <a href="{{ route('surat.download', $s->id_file) }}" 
                   class="btn btn-outline-primary btn-sm me-1" title="Download">
                  <i class="bi bi-download"></i>
                </a>

                <!-- Tombol Lihat pakai modal -->
                <button type="button" 
                        class="btn btn-outline-primary btn-sm" 
                        title="Lihat"
                        data-bs-toggle="modal" 
                        data-bs-target="#suratModal"
                        data-title="{{ $s->nama_file }}"
                        data-file="{{ asset('storage/surat/' . $s->nama_file) }}">
                  <i class="bi bi-eye"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>

<!-- Riwayat Surat -->
<div class="card shadow-lg mb-4">
  <div class="card-body">
    <h5 class="fw-semibold text-center mb-4">Riwayat Surat</h5>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th class="text-primary">Nama Surat</th>
            <th class="text-primary">Jenis Surat</th>
            <th class="text-primary">Status</th>
            <th class="text-primary text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($riwayatSurat ?? [] as $riwayat)
            <tr>
              <td>{{ $riwayat->nama_file }}</td>
              <td class="text-capitalize">{{ $riwayat->file_type }}</td>
              <td>
                <span class="badge bg-{{ $riwayat->status == 'Disetujui' ? 'success' : 'warning' }}">
                  {{ $riwayat->status }}
                </span>
              </td>
              <td class="text-center">
                <a href="{{ route('surat.download', $riwayat->id_file) }}" 
                   class="btn btn-outline-primary btn-sm me-1" title="Download">
                  <i class="bi bi-download"></i>
                </a>
                <!-- Tombol Lihat pakai modal -->
                <button type="button" 
                        class="btn btn-outline-primary btn-sm" 
                        title="Lihat"
                        data-bs-toggle="modal" 
                        data-bs-target="#suratModal"
                        data-title="{{ $riwayat->nama_file }}"
                        data-file="{{ asset('storage/surat/' . $riwayat->nama_file) }}">
                  <i class="bi bi-eye"></i>
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted">Belum ada riwayat surat</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Surat -->
<div class="modal fade" id="suratModal" tabindex="-1" aria-labelledby="suratModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="suratModalLabel">Detail Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <iframe id="suratFrame" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <a id="downloadSurat" href="#" class="btn btn-primary">
          <i class="bi bi-send"></i> Kirim Persetujuan
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var suratModal = document.getElementById('suratModal');
  suratModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var title = button.getAttribute('data-title');
    var file = button.getAttribute('data-file');

    suratModal.querySelector('.modal-title').textContent = title;
    suratModal.querySelector('#suratFrame').src = file;
    suratModal.querySelector('#downloadSurat').href = file;
  });
});
</script>
@endsection
