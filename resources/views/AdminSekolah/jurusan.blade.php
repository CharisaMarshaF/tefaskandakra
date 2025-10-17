@extends('layouts.admin')

@section('title', 'Konfigurasi Jurusan & Kelas Industri')

@section('content')
<div class="flex justify-between items-center mb-6">
  <div>
    <h2 class="text-2xl font-bold text-gray-800">Konfigurasi Jurusan & Kelas Industri</h2>
    <p class="text-gray-500 text-sm">Kelola jurusan dan kemitraan dengan dunia usaha dan industri.</p>
  </div>
  <div class="space-x-2">
    <button onclick="openModal('mitraModal')"
      class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg">
      <i class="fas fa-handshake mr-2"></i>Tambah Mitra DUDI
    </button>
    <button onclick="openModal('jurusanModal')"
      class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg">
      <i class="fas fa-plus mr-2"></i>Tambah Jurusan
    </button>
  </div>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="bg-white border border-gray-200 rounded-lg shadow p-4 flex justify-between items-center">
    <div>
      <p class="text-gray-500 text-sm font-medium">Total Jurusan</p>
      <h3 class="text-xl font-bold">{{ $totalJurusan }}</h3>
    </div>
    <i class="fas fa-book-reader text-indigo-500 text-2xl opacity-40"></i>
  </div>
  <div class="bg-white border border-gray-200 rounded-lg shadow p-4 flex justify-between items-center">
    <div>
      <p class="text-gray-500 text-sm font-medium">Total Project</p>
      <h3 class="text-xl font-bold">{{ $totalProject }}</h3>
    </div>
    <i class="fas fa-layer-group text-green-500 text-2xl opacity-40"></i>
  </div>
  <div class="bg-white border border-gray-200 rounded-lg shadow p-4 flex justify-between items-center">
    <div>
      <p class="text-gray-500 text-sm font-medium">Total Guru</p>
      <h3 class="text-xl font-bold">{{ $totalGuru }}</h3>
    </div>
    <i class="fas fa-chalkboard-teacher text-blue-500 text-2xl opacity-40"></i>
  </div>
  <div class="bg-white border border-gray-200 rounded-lg shadow p-4 flex justify-between items-center">
    <div>
      <p class="text-gray-500 text-sm font-medium">Mitra DUDI</p>
      <h3 class="text-xl font-bold">{{ $mitraDUDI }}</h3>
    </div>
    <i class="fas fa-building text-yellow-500 text-2xl opacity-40"></i>
  </div>
</div>

{{-- Daftar Jurusan --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  @forelse($jurusans as $jurusan)
  <div id="jurusan-card-{{ $jurusan->id }}" class="bg-white rounded-xl shadow border border-gray-200 hover:shadow-lg transition-transform">
    <div class="relative h-40 rounded-t-xl overflow-hidden">
      @if($jurusan->foto)
        <img src="{{ Storage::url($jurusan->foto) }}" alt="{{ $jurusan->nama_jurusan }}" class="w-full h-full object-cover">
      @else
        <div class="bg-indigo-700 w-full h-full flex items-center justify-center text-white font-semibold text-lg">
          {{ $jurusan->nama_jurusan }}
        </div>
      @endif
      <div class="absolute top-0 left-0 right-0 flex justify-between items-center bg-black bg-opacity-50 px-3 py-2 text-white">
        <h5 class="font-semibold">{{ $jurusan->nama_jurusan }}</h5>
        <div class="space-x-2">
          <button class="text-gray-200 hover:text-white btn-edit" data-id="{{ $jurusan->id }}">
            <i class="fas fa-pen"></i>
          </button>
          <button class="text-gray-200 hover:text-red-400 btn-delete" data-id="{{ $jurusan->id }}">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="p-4 flex justify-between text-center">
      <div class="flex-1">
        <p class="text-xl font-bold">{{ $jurusan->projects_count }}</p>
        <p class="text-gray-500 text-sm">Project</p>
      </div>
      <div class="flex-1">
        @php
        $mitra = $jurusan->projects->pluck('perusahaan')->whereNotNull()->unique('id')->take(2);
        @endphp
        @if($mitra->isEmpty())
          <p class="text-gray-400 text-sm">Belum ada mitra</p>
        @else
          <p class="text-gray-700 text-sm">{{ $mitra->pluck('nama')->join(', ') }}</p>
        @endif
        <p class="text-gray-500 text-sm">Mitra</p>
      </div>
    </div>
  </div>
  @empty
  <div class="col-span-2 text-center bg-white p-8 rounded-lg border border-gray-200 text-gray-500">
    Belum ada data jurusan.
  </div>
  @endforelse
</div>

{{-- Modal Jurusan --}}
<div id="jurusanModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
  <div class="bg-white w-full max-w-lg rounded-xl shadow-xl">
    <div class="flex justify-between items-center border-b px-6 py-3">
      <h3 id="jurusanModalTitle" class="text-lg font-semibold">Tambah Jurusan Baru</h3>
      <button onclick="closeModal('jurusanModal')" class="text-gray-500 hover:text-gray-800">&times;</button>
    </div>
    <form id="jurusanForm" class="p-6 space-y-4" enctype="multipart/form-data">
      <input type="hidden" id="jurusan_id" name="jurusan_id">
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
        <input id="nama_jurusan" name="nama_jurusan" type="text"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
        <p class="text-red-500 text-sm" id="nama_jurusan-error"></p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Kode Jurusan (Opsional)</label>
        <input id="kode_jurusan" name="kode_jurusan" type="text"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Kepala Jurusan (Opsional)</label>
        <input id="kepala_jurusan" name="kepala_jurusan" type="text"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="3"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
      </div>
      <div class="flex justify-end space-x-2 pt-4 border-t">
        <button type="button" onclick="closeModal('jurusanModal')" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-gray-800">Batal</button>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Simpan</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function openModal(id) {
  document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
}

$(document).ready(function() {
  // Buka modal Edit
  $('body').on('click', '.btn-edit', function() {
    const jurusanId = $(this).data('id');
    $('#jurusanModalTitle').text('Edit Jurusan');
    $('#jurusanForm')[0].reset();
    $('#foto-help').show();

    $.get(`/jurusan-kelas/${jurusanId}/edit`, function(data) {
      $('#jurusan_id').val(data.id);
      $('#nama_jurusan').val(data.nama_jurusan);
      $('#kode_jurusan').val(data.kode_jurusan);
      $('#kepala_jurusan').val(data.kepala_jurusan);
      $('#deskripsi').val(data.deskripsi);
      openModal('jurusanModal');
    }).fail(() => {
      Swal.fire('Gagal!', 'Tidak dapat mengambil data jurusan.', 'error');
    });
  });

  // Simpan / Update Jurusan
  $('#jurusanForm').submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const id = $('#jurusan_id').val();
    let url = id ? `/jurusan-kelas/${id}` : "{{ route('jurusan.store') }}";
    if (id) formData.append('_method', 'PUT');

    $.ajax({
      url,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: (res) => {
        closeModal('jurusanModal');
        Swal.fire('Sukses!', res.success, 'success').then(() => location.reload());
      },
      error: (xhr) => {
        let errors = xhr.responseJSON.errors;
        for (let key in errors) {
          $(`#${key}-error`).text(errors[key][0]);
        }
      }
    });
  });

  // Hapus Jurusan
  $('body').on('click', '.btn-delete', function() {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Yakin hapus?',
      text: 'Data jurusan akan dihapus permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/jurusan-kelas/${id}`,
          type: 'DELETE',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          success: (res) => {
            Swal.fire('Terhapus!', res.success, 'success');
            $(`#jurusan-card-${id}`).fadeOut(400, () => $(this).remove());
          },
          error: () => Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error')
        });
      }
    });
  });
});
</script>
@endpush
