<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Factory - Manajemen Stok Barang</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    @include('../sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="search-container">
                <input type="text" placeholder="search here...">
                <i class="bi bi-search search-icon"></i>
            </div>

<div class="user-section">
    <i class="bi bi-bell notification-icon"></i>
    <div class="user-profile">
        <div class="user-avatar"></div>
        <div class="user-info">
            <h6>Sukadi</h6>
            <small>Admin TEFA</small>
        </div>
        <i class="bi bi-chevron-down ms-2"></i>
    </div>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link text-danger p-0 ms-3" style="border: none; background: none;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>

        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title">
                    <h2>Manajemen Guru dan Siswa</h2>
                    <p>Kelola Guru dan Siswa</p>
                </div>
                <div class="header-buttons">
                    <div class="header-buttons mb-3">
                        <div class="d-flex gap-2">
                            <!-- Tombol Tambah Siswa -->
                            <button id="btnTambahSiswa" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahSiswaModal">
                                <i class="bi bi-plus"></i> Tambah Siswa
                            </button>

                            <!-- Tombol Tambah Guru -->
                            <button id="btnTambahGuru" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahGuruModal" style="display:none;">
                                <i class="bi bi-plus"></i> Tambah Guru
                            </button>
                        </div>
                    </div>

                    <!-- Modal Tambah Guru -->
                    <div class="modal fade" id="tambahGuruModal" tabindex="-1" aria-labelledby="tambahGuruModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="tambahGuruModalLabel"><i class="bi bi-person-plus"></i>
                                        Tambah Data Guru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('guru.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">NIP</label>
                                                <input type="text" name="nip" class="form-control"
                                                    placeholder="Masukkan NIP">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="Masukkan Nama Lengkap">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jurusan</label>
                                                <select name="id_jurusan" class="form-control" id="">
                                                    @foreach ($jurusan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Keahlian</label>
                                                <input type="text" name="keahlian" class="form-control"
                                                    placeholder="Masukkan Keahlian">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control"
                                                    placeholder="Masukkan Jabatan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                            Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="tambahSiswaModal" tabindex="-1"
                        aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="tambahSiswaModalLabel"><i
                                            class="bi bi-person-plus"></i>
                                        Tambah Data Siswa</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('siswa.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">NIS</label>
                                                <input type="text" name="nis" class="form-control"
                                                    placeholder="Masukkan NIS">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">NISN</label>
                                                <input type="text" name="nisn" class="form-control"
                                                    placeholder="Masukkan NISN">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" name="nama_lengkap" class="form-control"
                                                    placeholder="Masukkan Nama Lengkap">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <select name="gender" class="form-select">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control"
                                                    placeholder="Masukkan Tempat Lahir">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Alamat</label>
                                                <textarea name="alamat" class="form-control" rows="1" placeholder="Masukkan Alamat"></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Nomor HP</label>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="Masukkan Nomor HP">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Masukkan Email">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Kelas Industri</label>
                                                <select name="id_kelasindustri" class="form-select">
                                                    @foreach ($industri as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Kelas</label>
                                                <select name="id_kelas" class="form-select">
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Jurusan</label>
                                                <select name="id_jurusan" class="form-select">
                                                    @foreach ($jurusan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Angkatan</label>
                                                <input type="text" name="angkatan" class="form-control"
                                                    placeholder="Masukkan Angkatan">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                            Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="stat-value">5</div>
                    <p class="stat-label">Total Siswan</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-value">3</div>
                    <p class="stat-label">Total Guru</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="stat-value">2</div>
                    <p class="stat-label">User Aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-value">1</div>
                    <p class="stat-label">Total User</p>
                </div>
            </div>



            <!-- Filter Bar -->
            <div class="filter-bar">
                <!-- Filter Bar -->
                <div class="filter-bar">
                    <div class="filter-tabs">
                        <button class="filter-tab" id="tabSiswa" onclick="switchTab('siswa')">Siswa</button>
                        <button class="filter-tab active" id="tabGuru" onclick="switchTab('guru')">Guru</button>
                    </div>
                </div>


                <div class="filter-controls">
                    <input type="text" placeholder="Cari pesanan..." id="searchOrders">
                    <select id="statusFilter">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Processing</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                    <div></div>
                    <div></div>
                </div>
            </div>

            {{-- Guru --}}
            <div class="inventory-section">
                <div class="inventory-header">
                    <h5 id="tableTitle">Data Guru</h5>
                </div>

                <!-- Orders Table -->
                <div id="tableGuru" class="table-container inventory-table-wrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Nip</th>
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th>Keahlian</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jurusan->nama_jurusan }}</td>
                                    <td>{{ $item->keahlian }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Table -->
            <div class="inventory-section">
                <div class="inventory-header">
                    <h5 id="tableTitle">Data Siswa</h5>
                </div>

                <!-- Orders Table -->
                <div id="tableSiswa" class="table-container inventory-table-wrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Nis</th>
                                <th>Nisn</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Kelas Industri</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sigur as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->nis }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->jurusan->nama_jurusan }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->kelasindustris->nama_kelas ?? '-' }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->jurusan->nama_jurusan }}</td>
                                    <td>{{ $item->angkatan }}</td>
                                    <td>
                                        {{-- Modal Edit --}}
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content rounded-3 shadow">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title"
                                                            id="editModalLabel{{ $item->id }}"><i
                                                                class="bi bi-person-plus"></i>
                                                            Edit Data Siswa</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form action="{{ route('siswa.edit', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">NIS</label>
                                                                    <input type="text" name="nis"
                                                                        class="form-control"
                                                                        value="{{ $item->nis }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">NISN</label>
                                                                    <input type="text" name="nisn"
                                                                        class="form-control"
                                                                        value="{{ $item->nisn }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nama Lengkap</label>
                                                                    <input type="text" name="nama_lengkap"
                                                                        class="form-control"
                                                                        value="{{ $item->nama_lengkap }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Jenis Kelamin</label>
                                                                    <select name="gender" class="form-select">
                                                                        <option value="L"
                                                                            {{ $item->gender == 'L' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="P"
                                                                            {{ $item->gender == 'P' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Tempat Lahir</label>
                                                                    <input type="text" name="tempat_lahir"
                                                                        class="form-control"
                                                                        value="{{ $item->tempat_lahir }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Tanggal Lahir</label>
                                                                    <input type="date" name="tanggal_lahir"
                                                                        class="form-control"
                                                                        value="{{ $item->tanggal_lahir }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" rows="1">{{ $item->alamat }}</textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nomor HP</label>
                                                                    <input type="text" name="phone"
                                                                        class="form-control"
                                                                        value="{{ $item->phone }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        value="{{ $item->email }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Kelas Industri</label>
                                                                    <select name="id_kelasindustri"
                                                                        class="form-select">
                                                                        @foreach ($industri as $ind)
                                                                            <option value="{{ $ind->id }}"
                                                                                {{ $item->id_kelasindustri == $ind->id ? 'selected' : '' }}>
                                                                                {{ $ind->nama_kelas }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Kelas</label>
                                                                    <select name="id_kelas" class="form-select">
                                                                        @foreach ($kelas as $kel)
                                                                            <option value="{{ $kel->id }}"
                                                                                {{ $item->id_kelas == $kel->id ? 'selected' : '' }}>
                                                                                {{ $kel->nama_kelas }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jurusan</label>
                                                                    <select name="id_jurusan" class="form-select">
                                                                        @foreach ($jurusan as $jur)
                                                                            <option value="{{ $jur->id }}"
                                                                                {{ $item->id_jurusan == $jur->id ? 'selected' : '' }}>
                                                                                {{ $jur->nama_jurusan }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Angkatan</label>
                                                                    <input type="text" name="angkatan"
                                                                        class="form-control"
                                                                        value="{{ $item->angkatan }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="bi bi-save"></i>
                                                                Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('siswa.hapus', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash-fill"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 1rem;
        }

        .filter-tab {
            border: none;
            background-color: #f0f0f0;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .filter-tab.active {
            background-color: #2563eb;
            color: white;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inventory-table th,
        .inventory-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .inventory-table th {
            background: #f9fafb;
        }

        .table-container {
            transition: opacity 0.3s ease;
        }
    </style>


    <script>
        function switchTab(tab) {
            const tabSiswa = document.getElementById('tabSiswa');
            const tabGuru = document.getElementById('tabGuru');
            const tableSiswa = document.getElementById('tableSiswa');
            const tableGuru = document.getElementById('tableGuru');
            const btnSiswa = document.getElementById('btnTambahSiswa');
            const btnGuru = document.getElementById('btnTambahGuru');

            if (tab === 'siswa') {
                tabSiswa.classList.add('active');
                tabGuru.classList.remove('active');
                tableSiswa.style.display = 'block';
                tableGuru.style.display = 'none';
                btnSiswa.style.display = 'inline-block';
                btnGuru.style.display = 'none';
            } else {
                tabGuru.classList.add('active');
                tabSiswa.classList.remove('active');
                tableGuru.style.display = 'block';
                tableSiswa.style.display = 'none';
                btnGuru.style.display = 'inline-block';
                btnSiswa.style.display = 'none';
            }
        }
    </script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
</body>

</html>
