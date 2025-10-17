@extends('layouts.siswa.App')

@section('contents')
<h1 class="fs-3 fw-bold text-dark mb-2">Gabung Kelas Industri</h1>
<p class="text-muted mb-4">Pilih kelas Industri Terbaikmu, Untuk Mewujudkan Kemajuan Pemikiran</p>

<section>
  <div class="row g-4">
    @foreach ($perusahaan as $p)
      <div class="col-md -3 col-md-4 col-sm-6">
        <div class="card shadow-sm h-100">
          <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2940&auto=format&fit=crop" 
               class="card-img-top" 
               alt="{{ $p->nama }}">
          <div class="card-body bg-light">
            <h5 class="card-title fw-bold">{{ $p->nama }}</h5>
            <p class="card-text text-muted mb-3">{{ $p->alamat }}</p>
            <div class="d-flex gap-2">
              <!-- Modal Trigger -->
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id }}">
                Lihat Detail
              </button>
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#seleksiModal{{ $p->id }}">
                Ikut Seleksi
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Detail -->
      <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $p->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel{{ $p->id }}">Detail Perusahaan: {{ $p->nama }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <p><strong>Nama Perusahaan:</strong> {{ $p->nama }}</p>
              <p><strong>Alamat:</strong> {{ $p->alamat }}</p>
              <p><strong>Nama PIC:</strong> {{ $p->pic_name }}</p>
              <p><strong>Email PIC:</strong> {{ $p->pic_email }}</p>
              <p><strong>No Telepon:</strong> {{ $p->pic_phone }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Seleksi -->
      <div class="modal fade" id="seleksiModal{{ $p->id }}" tabindex="-1" aria-labelledby="seleksiModalLabel{{ $p->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <form action="#" method="POST">
            @csrf
            <input type="hidden" name="perusahaan" value="{{ $p->nama }}">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="seleksiModalLabel{{ $p->id }}">Form Ikut Seleksi - {{ $p->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jurusan</label>
                  <input type="text" class="form-control" name="jurusan" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kelas</label>
                  <input type="number" class="form-control" name="kelas" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alasan Mengikuti Seleksi</label>
                  <textarea class="form-control" name="alasan" rows="3" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    @endforeach
  </div>
</section>
@endsection
