@extends('layouts.waka.waka.waka')

@section('title', 'Daftar Nilai Project')

@section('content')
    <div class="content-card p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-3 fw-bold text-dark mb-0">Daftar Nilai Project</h1>
            <button class="btn btn-purple d-flex align-items-center gap-2 custom-btn" data-bs-toggle="modal"
                data-bs-target="#addModal">
                <i class="fa-solid fa-plus"></i> Tambah Nilai
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Project</th>
                        <th>Nilai</th>
                        <th>Feedback</th>
                        <th>Graded By</th>
                        <th>Graded At</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $g)
                        <tr>
                            <td>{{ $g['id_siswa'] }}</td>
                            <td>{{ $g['siswa']['nama_lengkap'] ?? '-' }}</td>
                            <td>{{ $g['siswa']['kelas']['nama_kelas'] ?? '-' }}</td>
                            <td>{{ $g['project']['nama_project'] ?? '-' }}</td>
                            <td>{{ $g['nilai'] }}</td>
                            <td>{{ $g['feedback'] }}</td>
                            <td>{{ $g['graded_by'] }}</td>
                            <td>{{ $g['graded_at'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning"
                                onclick="openEditModal(
                                    {{ $g['id'] }},
                                    {{ $g['project']['id'] ?? 'null' }},
                                    {{ $g['siswa']['id'] ?? 'null' }},
                                    {{ $g['nilai'] ?? 0 }},
                                    `{{ $g['feedback'] ?? '' }}`
                                )">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            

                                <form method="POST" action="{{ route('nilai.destroy', $g['id']) }}" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if(count($grades) == 0)
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('nilai.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Project</label>
                            <select name="id_project" onchange="loadSiswa(this.value)" class="form-select" required>
                                <option value="">-- Pilih Project --</option>
                                @foreach ($projects as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['nama_project'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Siswa</label>
                            <select name="id_siswa" id="select_siswa" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nilai</label>
                            <input type="number" name="nilai" step="0.01" min="0" max="100" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Feedback</label>
                            <textarea name="feedback" class="form-control" rows="3"></textarea>
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

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Project</label>
                            <select name="id_project" id="edit_id_project" onchange="loadEditSiswa(this.value)"
                                class="form-select" required>
                                <option value="">-- Pilih Project --</option>
                                @foreach ($projects as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['nama_project'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Siswa</label>
                            <select name="id_siswa" id="edit_id_siswa" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nilai</label>
                            <input type="number" name="nilai" id="edit_nilai" step="0.01" min="0" max="100"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Feedback</label>
                            <textarea name="feedback" id="edit_feedback" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-purple">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const projects = @json($projects);

        function loadSiswa(projectId) {
            const select = document.getElementById('select_siswa');
            select.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            const project = projects.find(p => p.id == projectId);
            if (project && project.projectmember) {
                project.projectmember.forEach(m => {
                    if (m.siswa) {
                        const opt = document.createElement('option');
                        opt.value = m.siswa.id;
                        opt.text = `${m.siswa.nama_lengkap} (${m.role})`;
                        select.appendChild(opt);
                    }
                });
            }
        }

        function loadEditSiswa(projectId, selectedId = null) {
            const select = document.getElementById('edit_id_siswa');
            select.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            const project = projects.find(p => p.id == projectId);
            if (project && project.projectmember) {
                project.projectmember.forEach(m => {
                    if (m.siswa) {
                        const opt = document.createElement('option');
                        opt.value = m.siswa.id;
                        opt.text = `${m.siswa.nama_lengkap} (${m.role})`;
                        if (selectedId && m.siswa.id == selectedId) opt.selected = true;
                        select.appendChild(opt);
                    }
                });
            }
        }

        function openEditModal(id, projectId, siswaId, nilai, feedback) {
            const modal = new bootstrap.Modal(document.getElementById("editModal"));
            modal.show();

            document.getElementById('edit_id').value = id; // isi hidden input
            document.getElementById('editForm').action = `/waka/nilai/${id}`;
            document.getElementById('edit_id_project').value = projectId;
            loadEditSiswa(projectId, siswaId);
            document.getElementById('edit_nilai').value = nilai;
            document.getElementById('edit_feedback').value = feedback;
        }


    </script>
@endpush
