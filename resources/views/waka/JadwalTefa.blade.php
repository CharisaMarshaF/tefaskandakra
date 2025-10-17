@extends('layouts.waka.waka.waka')

@section('title', 'Jadwal TEFA - Teaching Factory')

@section('content')
    <div class="content-card p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-3 fw-bold text-dark mb-0">Jadwal TEFA</h1>
            <button class="btn btn-purple d-flex align-items-center gap-2 custom-btn" onclick="openAddModal()">
                <i class="fa-solid fa-plus"></i> Tambah Jadwal
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Project</th>
                        <th>Guru</th>
                        <th>Client</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $row)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($row['tanggal_mulai'])->format('d-m-Y') }} s/d
                                {{ \Carbon\Carbon::parse($row['tanggal_selesai'])->format('d-m-Y') }}
                                <br>
                                <small class="text-muted">({{ $row['jam_mulai'] }} -
                                    {{ $row['jam_selesai'] }})</small>
                            </td>
                            <td>{{ $row['project']['jurusan']['nama_jurusan'] ?? '-' }}</td>
                            <td>{{ $row['kelasindustri']['nama_kelas'] ?? '-' }}</td>
                            <td>{{ $row['project']['nama_project'] ?? '-' }}</td>
                            <td>{{ $row['project']['guru']['nama'] ?? '-' }}</td>
                            <td>{{ $row['project']['perusahaan']['nama'] ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick='openEditModal(@json($row))'>
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form action="{{ route('jadwal-tefa.destroy', $row['id']) }}" method="POST"
                                    style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah & Edit digabung --}}
    <div class="modal fade" id="jadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="jadwalForm">
                    @csrf
                    <input type="hidden" id="form_method" name="_method" value="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Tambah Jadwal TEFA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Project</label>
                            <select id="id_project" name="id_project" class="form-select">
                                @foreach($projects as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['nama_project'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Kelas</label>
                            <select id="id_kelasindustri" name="id_kelasindustri" class="form-select">
                                @foreach($kelasindustri as $k)
                                    <option value="{{ $k['id'] }}">{{ $k['nama_kelas'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" />
                            </div>
                            <div class="col">
                                <label>Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Jam Mulai</label>
                                <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" />
                            </div>
                            <div class="col">
                                <label>Jam Selesai</label>
                                <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" />
                            </div>
                        </div>
                        <div class="mt-3">
                            <label>Catatan</label>
                            <textarea id="catatan" name="catatan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-purple">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            const modal = new bootstrap.Modal(document.getElementById("jadwalModal"));
            document.getElementById("jadwalForm").reset();
            document.getElementById("jadwalForm").action = "{{ route('jadwal-tefa.store') }}";
            document.getElementById("form_method").value = "POST";
            document.getElementById("modalTitle").innerText = "Tambah Jadwal TEFA";
            modal.show();
        }

        function openEditModal(data) {
            const modal = new bootstrap.Modal(document.getElementById("jadwalModal"));
            const form = document.getElementById("jadwalForm");
            form.action = "/waka/jadwal-tefa/" + data.id;
            document.getElementById("form_method").value = "PUT";
            document.getElementById("modalTitle").innerText = "Edit Jadwal TEFA";

            document.getElementById("id_project").value = data.id_project;
            document.getElementById("id_kelasindustri").value = data.id_kelasindustri;
            document.getElementById("tanggal_mulai").value = data.tanggal_mulai;
            document.getElementById("tanggal_selesai").value = data.tanggal_selesai;
            document.getElementById("jam_mulai").value = data.jam_mulai;
            document.getElementById("jam_selesai").value = data.jam_selesai;
            document.getElementById("catatan").value = data.catatan;

            modal.show();
        }
    </script>
@endsection
