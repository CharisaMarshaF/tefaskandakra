@extends('siswa.layouts.app')

@section('content')
<style>
    /* Pastikan tombol bisa diklik dan tidak tertutupi */
    .content-card {
        position: relative;
        z-index: 1;
    }
</style>

<section class="content-card p-4 p-md-5">
    <h1 class="fs-3 fw-bold text-dark mb-2">Gabung Kelas Industri</h1>
    <p class="text-muted mb-4">Pilih kelas Industri Terbaikmu, Untuk Mewujudkan Kemajuan Pemikiran</p>

    <div class="row g-4">
        @foreach($perusahaan as $p)
            @foreach($p->lowongans as $lowongan)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm h-100">
                        {{-- Logo Perusahaan --}}
                        <img 
                            src="{{ $p->logo ? asset('storage/' . $p->logo) : asset('template/assets/img/default-logo.png') }}" 
                            class="card-img-top" 
                            alt="Logo Perusahaan" 
                            style="object-fit: cover; height: 200px;"
                        >

                        <div class="card-body bg-light">
                            <h5 class="card-title fw-bold">{{ $p->nama }}</h5>
                            <p class="card-text text-muted mb-3">{{ $lowongan->judul_lowongan }}</p>
                            <div class="d-flex gap-2">
                                {{-- Tombol Ikut Seleksi --}}
                                <button 
                                    type="button" 
                                    class="btn btn-outline-primary" 
                                    onclick="showSeleksi({{ $lowongan->id }})"
                                    @if($sudahMengajukan) disabled @endif
                                >
                                    Ikut Seleksi
                                </button>

                                {{-- Tombol Lihat Detail --}}
                                <button 
                                    type="button" 
                                    class="btn btn-primary" 
                                    onclick="showDetail({{ $lowongan->id }})"
                                >
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</section>

{{-- Modal Detail Lowongan --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Lowongan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content-detail">
                <p class="text-center text-muted">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

{{-- Modal Seleksi --}}
<div class="modal fade" id="seleksiModal" tabindex="-1" aria-labelledby="seleksiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seleksiModalLabel">Ajukan Seleksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSeleksi">
                    @csrf
                    <input type="hidden" name="id_lowongan" id="id_lowongan">

                    <div class="mb-3">
                        <label for="nama_lowongan" class="form-label">Lowongan</label>
                        <input type="text" id="nama_lowongan" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="posisi">Pilih Posisi</label>
                        <select name="id_posisi" id="posisi" class="form-control" required>
                            <option value="">-- Pilih Posisi --</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Ajukan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- jQuery dan SweetAlert2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    /**
     * Menampilkan detail lowongan
     */
    function showDetail(id) {
        $.get(`/siswa/kelas-industri/${id}/detail`, function(data) {
            let imgSrc = data.gambar ?? data.perusahaan.logo;

            let html = `
                <div class="text-center mb-3">
                    <img src="${imgSrc}" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <h4>${data.judul_lowongan}</h4>
                <p>${data.deskripsi}</p>
                <p><strong>Perusahaan:</strong> ${data.perusahaan.nama}</p>
                <p><strong>Periode:</strong> ${data.tanggal_mulai} - ${data.tanggal_selesai}</p>
                <h5 class="mt-3">Posisi yang Dibutuhkan:</h5>
                <ul>
            `;
            
            data.posisis.forEach(function(posisi) {
                html += `<li>${posisi.nama_posisi} (Butuh: ${posisi.jumlah_dibutuhkan})</li>`;
            });
            html += `</ul>`;

            $('#modal-content-detail').html(html);
            $('#detailModal').modal('show');
        }).fail(function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memuat detail lowongan',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }

    /**
     * Menampilkan form seleksi untuk lowongan tertentu
     */
    function showSeleksi(id) {
        $.get(`/siswa/kelas-industri/${id}/detail`, function(data) {
            $('#id_lowongan').val(data.id);
            $('#nama_lowongan').val(data.judul_lowongan);

            let posisiOptions = '<option value="">-- Pilih Posisi --</option>';
            data.posisis.forEach(function(posisi) {
                posisiOptions += `<option value="${posisi.id}">${posisi.nama_posisi} (Butuh: ${posisi.jumlah_dibutuhkan})</option>`;
            });
            $('#posisi').html(posisiOptions);

            $('#seleksiModal').modal('show');
        }).fail(function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memuat data seleksi',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }

    /**
     * Submit form seleksi
     */
    $('#formSeleksi').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route('siswa.kelas_industri.store') }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 2500,
                    showConfirmButton: false
                });

                $('#seleksiModal').modal('hide');

                // Optional: reload untuk update tombol disable
                setTimeout(() => {
                    location.reload();
                }, 2500);
            },
            error: function(xhr) {
                let message = 'Terjadi kesalahan.';

                if (xhr.status === 422 || xhr.status === 404) {
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: message,
                    timer: 3000,
                    showConfirmButton: true
                });
            }
        });
    });
</script>
@endsection
