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
                    <h2>Manajemen Produksi</h2>
                    <p>Kelola dan pantau produksi TEFA</p>
                </div>
                <!-- Tombol -->
                <div class="header-buttons">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                        <i class="bi bi-plus"></i> Tambah Jadwal
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-3 shadow">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahJadwalLabel">Tambah Jadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <form action="{{ route('produksi.tambah') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="namaJadwal" class="form-label">Project</label>
                                        <select name="id_project" id="" class="form-control">
                                            @foreach ($project as $item)
                                                <option value="{{ $item->id }}" id="">
                                                    {{ $item->kode_project }} - {{ $item->nama_project }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="namaJadwal" class="form-label">Kelas Industri</label>
                                        <select name="id_kelasindustri" id="" class="form-control">
                                            @foreach ($industris as $item)
                                                <option value="{{ $item->id }}" id="">
                                                    {{ $item->kode_kelas }} - {{ $item->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal"
                                            name="tanggal_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tanggal"
                                            name="tanggal_selesai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Jam Mulai</label>
                                        <input type="time" class="form-control" name="jam_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" name="jam_selesai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="keterangan" name="catatan" rows="3" placeholder="Masukkan catatan..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-list-task"></i>
                    </div>
                    <div class="stat-value">2</div>
                    <p class="stat-label">Antrian Job</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-play-circle"></i>
                    </div>
                    <div class="stat-value">4</div>
                    <p class="stat-label">Sedang Produksi</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-value">8</div>
                    <p class="stat-label">Selesai Hari Ini</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value">2</div>
                    <p class="stat-label">Perlu Tindakan</p>
                </div>
            </div>

            <!-- Alert -->
            <div class="critical-alert">
                <i class="bi bi-exclamation-triangle-fill alert-icon"></i>
                <p class="alert-text">
                    <strong>Peringatan Deadline!</strong>
                    Ada 2 pekerjaan yang mendekati deadline dan memerlukan perhatian khusus
                </p>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar" style="margin-bottom: 20px;">
                <div class="filter-tabs" style="display: flex; gap: 10px;">
                    <button class="filter-tab active" id="allProductionTab" onclick="switchProductionTab('all')">
                        Semua Produksi
                    </button>
                    <button class="filter-tab" id="inProgressTab" onclick="switchProductionTab('progress')">
                        Tim
                    </button>

                </div>
            </div>

            <!-- ✅ TABEL (Tim) -->
            <div id="tabelTim" style="display: none;">
                <div
                    style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; overflow-x: auto;  margin: 0 auto;">
                    <h6 style="font-weight: 600; margin-bottom: 15px; color: #1a202c;">Daftar Produksi Tim</h6>

                    @foreach ($members as $projectId => $projectMembers)
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Tim: {{ $projectId }}</h6>
                            </div>

                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projectMembers as $member)
                                            <tr>
                                                <td>{{ $member->siswa->nama_lengkap ?? '-' }}</td>
                                                <td>{{ $member->role ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <!-- ✅ PRODUCTION GRID (Semua Produksi) -->
            <div id="semuaProduksi" class="production-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
                @foreach ($produksis as $item)
                    <div class="production-card"
                        style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                            <h6 style="font-weight: 600; margin: 0; color: #1a202c;">
                                {{ $item->project->nama_project }}
                            </h6>
                            <span class="status-badge status-processing" style="font-size: 11px;">Sedang
                                Produksi</span>
                        </div>
                        <div style="font-size: 13px; color: #6c757d; margin-bottom: 15px;">
                            <strong>{{ $item->project->kode_project }}</strong>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <div
                                style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px;">
                                <span style="color: #1a202c;">PM: {{ $item->project->guru->nama }}</span>
                                <span style="color: #ef4444;">Deadline: {{ $item->tanggal_selesai }}</span>
                            </div>

                            <!-- Progress Bar -->
                            <div
                                style="background: #f1f5f9; height: 8px; border-radius: 4px; margin-bottom: 8px; overflow: hidden;">
                                <div style="background: #3b82f6; height: 100%; width: 75%; border-radius: 4px;"></div>
                            </div>
                            <div style="font-size: 12px; color: #6c757d; text-align: right;">75%</div>
                        </div>

                        <button
                            style="width: 100%; padding: 8px; background: transparent; border: 1px solid #e2e8f0; border-radius: 6px; color: #6c757d; font-size: 13px; cursor: pointer;">
                            Catatan: {{ $item->catatan }}
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- ✅ JavaScript -->
            <script>
                function switchProductionTab(tab) {
                    const allTab = document.getElementById('allProductionTab');
                    const progressTab = document.getElementById('inProgressTab');
                    const semuaProduksi = document.getElementById('semuaProduksi');
                    const tabelTim = document.getElementById('tabelTim');

                    // Reset active state
                    [allTab, progressTab].forEach(btn => btn.classList.remove('active'));

                    // Hide all sections
                    semuaProduksi.style.display = "none";
                    tabelTim.style.display = "none";

                    // Show based on selected tab
                    if (tab === 'all') {
                        semuaProduksi.style.display = "grid";
                        allTab.classList.add('active');
                    } else if (tab === 'progress') {
                        tabelTim.style.display = "block";
                        progressTab.classList.add('active');
                    }
                }
            </script>

            <!-- ✅ Gaya tombol tab -->
            <style>
                .filter-tab {
                    background: #f1f5f9;
                    border: none;
                    border-radius: 6px;
                    padding: 8px 16px;
                    font-size: 13px;
                    cursor: pointer;
                    color: #334155;
                    transition: all 0.2s;
                }

                .filter-tab:hover {
                    background: #e2e8f0;
                }

                .filter-tab.active {
                    background: #3b82f6;
                    color: white;
                }
            </style>

        </div>
    </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
</body>

</html>
