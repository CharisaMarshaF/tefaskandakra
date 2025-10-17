@extends('layouts.waka.waka.waka')

@section('title', 'Jadwal Kelas Industri')

@section('content')
    <div class="content-card p-4 p-md-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-3 fw-bold text-dark mb-0">Jadwal Kelas Industri</h1>
            <button class="btn btn-purple d-flex align-items-center gap-2 custom-btn" data-bs-toggle="modal"
                data-bs-target="#addModal">
                <i class="fa-solid fa-plus"></i> Tambah Projek
            </button>
        </div>

        {{-- Tabs Jurusan --}}
        <ul class="nav nav-tabs" id="jurusanTabs" role="tablist">
            @foreach ($jurusan as $key => $jrs)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == 0) active @endif" id="tab-{{ $jrs['id'] }}" data-bs-toggle="tab"
                        data-bs-target="#content-{{ $jrs['id'] }}" type="button" role="tab"
                        aria-controls="content-{{ $jrs['id'] }}" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                        {{ $jrs['nama_jurusan'] }}
                    </button>
                </li>
            @endforeach
        </ul>

        {{-- Content Jurusan --}}
        <div class="tab-content mt-3" id="jurusanTabsContent">
            @foreach ($jurusan as $key => $jrs)
                @php
                    $jadwalJurusan = $data->where('id_jurusan', $jrs['id']);
                @endphp

                <div class="tab-pane fade @if($key == 0) show active @endif" id="content-{{ $jrs['id'] }}" role="tabpanel"
                    aria-labelledby="tab-{{ $jrs['id'] }}">

                    @if($jadwalJurusan->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Guru Pendamping</th>
                                    <th>Mitra</th>
                                    <th>Projek</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalJurusan as $item)
                                    <tr>
                                        <td>{{ $item['kelasindustri']['nama_kelas'] ?? '-' }}</td>
                                        <td>{{ $item['guru']['nama'] ?? '-' }}</td>
                                        <td>{{ $item['perusahaan']['nama'] ?? '-' }}</td>
                                        <td>{{ $item['nama_project'] }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-edit" data-item='@json($item)'>
                                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                            </a>

                                            <form action="{{ route('jadwal-kelas-industri.destroy', $item['id']) }}" method="POST"
                                                style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0"
                                                    onclick="return confirm('Yakin hapus?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-muted mt-4">
                            Tidak ada jadwal untuk jurusan {{ ucfirst($jrs['nama_jurusan']) }}.
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
        </div>

        {{-- Modal Tambah --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('jadwal-kelas-industri.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Projek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode Project</label>
                            <input type="text" name="kode_project" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Nama Project</label>
                            <input type="text" name="nama_project" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label>Deadline</label>
                                <input type="date" name="deadline" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Output</label>
                            <input type="text" name="expected_output" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label>Guru</label>
                                <select name="id_guru" class="form-control">
                                    @foreach ($guru as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Perusahaan</label>
                                <select name="id_perusahaan" class="form-control">
                                    @foreach ($perusahaan as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Jurusan</label>
                                <select name="id_jurusan" class="form-control">
                                    @foreach ($jurusan as $j)
                                        <option value="{{ $j['id'] }}">{{ $j['nama_jurusan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Kelas</label>
                                <select name="id_kelasindustri" class="form-control">
                                    @foreach ($kelasindustri as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-purple">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" class="modal-content" id="editForm">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Projek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode Project</label>
                            <input type="text" name="kode_project" id="edit_kode_project" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Nama Project</label>
                            <input type="text" name="nama_project" id="edit_nama_project" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" id="edit_start_date" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label>Deadline</label>
                                <input type="date" name="deadline" id="edit_deadline" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Output</label>
                            <input type="text" name="expected_output" id="edit_expected_output" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label>Guru</label>
                                <select name="id_guru" id="edit_id_guru" class="form-control">
                                    @foreach ($guru as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Perusahaan</label>
                                <select name="id_perusahaan" id="edit_id_perusahaan" class="form-control">
                                    @foreach ($perusahaan as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Jurusan</label>
                                <select name="id_jurusan" id="edit_id_jurusan" class="form-control">
                                    @foreach ($jurusan as $j)
                                        <option value="{{ $j['id'] }}">{{ $j['nama_jurusan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label>Kelas</label>
                                <select name="id_kelasindustri" id="edit_id_kelasindustri" class="form-control">
                                    @foreach ($kelasindustri as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-purple">Update</button>
                    </div>
                </form>
            </div>
        </div>
@endsection

    @push('scripts')
        <script>
            document.querySelectorAll(".btn-edit").forEach(btn => {
                btn.addEventListener("click", function () {
                    const data = JSON.parse(this.getAttribute("data-item"));
                    openEditModal(data);
                });
            });

            function openEditModal(data) {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();
                const form = document.getElementById("editForm");
                form.action = "/waka/jadwal-kelas-industri/" + data['id'];

                document.getElementById("edit_kode_project").value = data['kode_project'] ?? '';
                document.getElementById("edit_nama_project").value = data['nama_project'] ?? '';
                document.getElementById("edit_deskripsi").value = data['deskripsi'] ?? '';
                document.getElementById("edit_start_date").value = data['start_date'] ?? '';
                document.getElementById("edit_deadline").value = data['deadline'] ?? '';
                document.getElementById("edit_status").value = data['status'] ?? 'draft';
                document.getElementById("edit_expected_output").value = data['expected_output'] ?? '';

                document.getElementById("edit_id_guru").value = data['id_guru'];
                document.getElementById("edit_id_perusahaan").value = data['id_perusahaan'];
                document.getElementById("edit_id_jurusan").value = data['id_jurusan'];
                document.getElementById("edit_id_kelasindustri").value = data['id_kelasindustri'];
            }
        </script>
    @endpush
