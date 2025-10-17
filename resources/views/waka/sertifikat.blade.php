@extends('layouts.waka.waka.waka')

@section('title', 'Daftar Sertifikat')

@section('content')
    <div class="content-card p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-3 fw-bold text-dark mb-0">Daftar Sertifikat</h1>
            <button class="btn btn-purple d-flex align-items-center gap-2" data-bs-toggle="modal"
                data-bs-target="#addModal">
                <i class="fa-solid fa-plus"></i> Tambah Sertifikat
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Project</th>
                        <th>Nilai</th>
                        <th>Feedback</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $g)
                        <tr>
                            <td>{{ $g['id'] }}</td>
                            <td>{{ $g['siswa']['nama_lengkap'] ?? '-' }}</td>
                            <td>{{ $g['siswa']['kelas']['nama_kelas'] ?? '-' }}</td>
                            <td>{{ $g['project']['nama_project'] ?? '-' }}</td>
                            <td>{{ $g['nilai'] ?? '-' }}</td>
                            <td>{{ $g['feedback'] ?? '-' }}</td>
                            <td>
                                @if(isset($g['file']['nama_file']))
                                    <button class="btn btn-sm btn-outline-purple"
                                        onclick="previewSertifikat('{{ asset('storage/' . $g['file']['nama_file']) }}')">
                                        <i class="fa fa-print"></i>
                                    </button>
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning"
                                    onclick="openEditModal({{ $g['id'] }}, {{ $g['project']['id'] ?? 'null' }}, {{ $g['siswa']['id'] ?? 'null' }}, {{ $g['nilai'] ?? 0 }}, `{{ $g['feedback'] ?? '' }}`)">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('sertifikat.destroy', $g['id']) }}" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Project</label>
                            <select name="id_project" id="add_id_project" class="form-select" required
                                onchange="loadAddSiswa(this.value)">
                                <option value="">-- Pilih Project --</option>
                                @foreach ($projects as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['nama_project'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Siswa</label>
                            <select name="id_siswa" id="add_id_siswa" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nilai</label>
                            <input type="number" step="0.01" name="nilai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Feedback</label>
                            <textarea name="feedback" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Upload Sertifikat</label>
                            <input type="file" name="sertifikat" class="form-control">
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
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Project</label>
                            <select name="id_project" id="edit_id_project" class="form-select" required
                                onchange="loadEditSiswa(this.value)">
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
                            <input type="number" name="nilai" id="edit_nilai" step="0.01" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Feedback</label>
                            <textarea name="feedback" id="edit_feedback" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Upload Sertifikat</label>
                            <input type="file" name="sertifikat" class="form-control">
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

    {{-- Modal Preview --}}
    <div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center" style="height: 80vh;">
                    <div id="sertifikatPreview" class="w-100 h-100"></div>
                </div>
                <div class="modal-footer">
                    <a id="downloadBtn" href="#" class="btn btn-purple" target="_blank">
                        <i class="fa fa-download"></i> Download
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const projects = @json($projects);

        function openEditModal(id, id_project, id_siswa, nilai) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_id_project').value = id_project;

            loadEditSiswa(id_project, id_siswa);

            document.getElementById('edit_nilai').value = nilai;

            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }


        function loadEditSiswa(projectId, selectedSiswaId = null) {
            const select = document.getElementById('edit_id_siswa');
            select.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            const project = projects.find(p => p.id == projectId);
            if (project && project.projectmember) {
                project.projectmember.forEach(m => {
                    if (m.siswa) {
                        const opt = document.createElement('option');
                        opt.value = m.siswa.id;
                        opt.text = `${m.siswa.nama_lengkap} (${m.role})`;
                        if (selectedSiswaId && m.siswa.id == selectedSiswaId) {
                            opt.selected = true;
                        }
                        select.appendChild(opt);
                    }
                });
            }
        }

        function loadAddSiswa(projectId) {
            const select = document.getElementById('add_id_siswa');
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


        function previewSertifikat(path) {
            if (!path) {
                alert('File sertifikat belum tersedia.');
                return;
            }

            let previewContainer = document.getElementById("sertifikatPreview");
            previewContainer.innerHTML = ""; // reset konten

            if (path.toLowerCase().endsWith(".pdf")) {
                // Tampilkan PDF pakai embed
                previewContainer.innerHTML = `<embed src="${path}" type="application/pdf" width="100%" height="100%">`;
            } else {
                // Tampilkan gambar
                previewContainer.innerHTML = `<img src="${path}" alt="Preview Sertifikat" class="img-fluid">`;
            }

            document.getElementById("downloadBtn").href = path;

            var modal = new bootstrap.Modal(document.getElementById('printModal'));
            modal.show();
        }


        function printImage() {
            let src = document.getElementById("sertifikatImg").src;
            let w = window.open("");
            w.document.write('<img src="' + src + '" style="width:100%">');
            w.print();
            w.close();
        }
    </script>
@endpush