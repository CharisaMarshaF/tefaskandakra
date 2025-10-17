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
<style>
    .success-alert {
        display: flex;
        align-items: center;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 12px 16px;
        border-radius: 5px;
        margin: 10px 0;

    }

    .action-dropdown {
        display: none;
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 8px 0;
        min-width: 150px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        z-index: 100;
    }

    .action-cell {
        position: relative;
    }

    .action-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
    }

    .action-dropdown .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .action-dropdown.show {
        display: block;
    }
</style>
<script>
    function toggleDropdown(button) {
        // Tutup semua dropdown lain
        document.querySelectorAll('.action-dropdown').forEach(el => el.classList.remove('show'));

        // Toggle dropdown pada tombol yang diklik
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('show');
    }

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        const isActionMenu = e.target.closest('.action-cell');
        if (!isActionMenu) {
            document.querySelectorAll('.action-dropdown').forEach(el => el.classList.remove('show'));
        }
    });
</script>


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
                    <h2>Manajemen Stok Barang</h2>
                    <p>Kelola Inventori bahan baku untuk produksi TEFA</p>
                </div>
                <div class="header-buttons">
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalStokBahan">
                        <i class="bi bi-arrow-up-short"></i> Stok Masuk/Keluar
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBahan">
                        <i class="bi bi-plus"></i> Tambah Bahan
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalTambahBahan" tabindex="-1" aria-labelledby="modalTambahBahanLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg"> <!-- Gunakan modal-lg untuk lebar ekstra -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahBahanLabel">Tambah Bahan Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahBahan" action="{{ route('stok.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_bahan" class="form-label">Kode Bahan</label>
                                        <input type="text" class="form-control" id="kode_bahan" name="kode_bahan"
                                            value="{{ $kode_bahan }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                        <input type="text" class="form-control" id="nama_bahan" name="nama_bahan"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jenis" class="form-label">Jenis</label>
                                        <input type="text" class="form-control" id="jenis" name="jenis">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok"
                                            min="0" value="0" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="minimal_stok" class="form-label">Minimal Stok</label>
                                        <input type="number" class="form-control" id="minimal_stok"
                                            name="minimal_stok" min="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control" id="harga_satuan"
                                            name="harga_satuan" min="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_jurusan" class="form-label">Jurusan</label>
                                        <select name="id_jurusan" id="" class="form-control">
                                            <option value="" disabled="disabled" selected="selected">Pilih
                                                Jurusan
                                            </option>
                                            @foreach ($jurusan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="formTambahBahan" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modalStokBahan" tabindex="-1" aria-labelledby="modalStokhBahanLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg"> <!-- Gunakan modal-lg untuk lebar ekstra -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalStokBahanLabel">Tambah Stok Bahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahBahan" action="{{ route('tambahStok') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="">Bahan</label>
                                        <select name="id_bahan" id="" class="form-control">
                                            <option value="" selected>-- Pilih Bahan --</option>
                                            @foreach ($bahans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_bahan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jenis" class="form-label">Jenis</label>

                                        <select name="jenis" id="" class="form-control">
                                            <option value="masuk">Masuk</option>
                                            <option value="keluar">Keluar</option>
                                            <option value="adjust">Adjust</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="supplier" class="form-label">qty</label>
                                        <input type="number" class="form-control" id="supplier" name="qty">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="stok" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="minimal_stok" class="form-label">Reference</label>
                                        <input type="text" class="form-control" id="minimal_stok"
                                            name="reference" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="harga_satuan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea>
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


            {{-- EDIT MODAL --}}
            <!-- Modal Edit Bahan -->


            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-box"></i>
                    </div>
                    <div class="stat-value">5</div>
                    <p class="stat-label">Total Bahan</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="stat-value">1</div>
                    <p class="stat-label">Stok Kritis</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-value">4</div>
                    <p class="stat-label">Supplier Aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="stat-value">1</div>
                    <p class="stat-label">Pergerakan Hari Ini</p>
                </div>
            </div>

            @if (session('success'))
                <div class="success-alert">
                    <p class="alert-text">
                        <strong>Sukses!</strong>
                        {{ session('success') }}
                    </p>
                </div>
            @endif
            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-tabs">
                    <button class="filter-tab active" id="inventoryTab" onclick="switchTab('inventory')">Daftar
                        Barang</button>
                    <button class="filter-tab" id="movementTab" onclick="switchTab('movement')">Pergerakan
                        Stok</button>
                </div>
                <div class="filter-controls">
                    <input type="text" placeholder="Cari bahan...">
                    <select>
                        <option>Semua Kategori</option>
                        <option>Tekstil</option>
                        <option>Logam</option>
                        <option>Elektronik</option>
                    </select>
                    <select>
                        <option>Semua Status</option>
                        <option>Normal</option>
                        <option>Kritis</option>
                        <option>Warning</option>
                    </select>
                    <div></div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="inventory-section">
                <div class="inventory-header">
                    <h5 id="tableTitle">Inventori Bahan Baku</h5>
                    <p id="tableSubtitle">Daftar lengkap bahan baku dan status stok terkini</p>
                </div>

                <!-- Inventory Table -->
                <div class="table-container inventory-table-wrapper" id="inventoryTableWrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Nama Bahan</th>
                                <th>Kategori</th>
                                <th>Stok Saat Ini</th>
                                <th>Status</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Terakhir di isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahans as $item)
                                <tr>
                                    <td>{{ $item->nama_bahan }}</td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>
                                        <div class="stock-info">
                                            <span class="stock-current">{{ $item->stok }}</span>
                                            <span class="stock-min">Min. {{ $item->minimal_stok }}</span>
                                        </div>
                                    </td>
                                    <td><span class="status-badge status-normal">Normal</span></td>
                                    <td>{{ $item->satuan }}</td>
                                    <td class="price-cell">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </td>
                                    <td>2025-01-10</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEditBahan">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>

                                            <form action="{{ route('hapusBahan', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <div class="modal fade" id="modalEditBahan" tabindex="-1"
                                        aria-labelledby="modalEditBahanLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditBahanLabel">Edit Bahan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form id="formEditBahan"
                                                        action="{{ route('update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="kode_bahan" class="form-label">Kode
                                                                    Bahan</label>
                                                                <input type="text" class="form-control"
                                                                    id="kode_bahan" name="kode_bahan"
                                                                    value="{{ $item->kode_bahan }}" readonly>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="nama_bahan" class="form-label">Nama
                                                                    Bahan</label>
                                                                <input type="text" class="form-control"
                                                                    id="nama_bahan" name="nama_bahan"
                                                                    value="{{ $item->nama_bahan }}" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="jenis" class="form-label">Jenis</label>
                                                                <input type="text" class="form-control"
                                                                    id="jenis" name="jenis"
                                                                    value="{{ $item->jenis }}">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="satuan"
                                                                    class="form-label">Satuan</label>
                                                                <input type="text" class="form-control"
                                                                    id="satuan" name="satuan"
                                                                    value="{{ $item->satuan }}">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="stok" class="form-label">Stok</label>
                                                                <input type="number" class="form-control"
                                                                    id="stok" name="stok"
                                                                    value="{{ $item->stok }}" min="0">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="minimal_stok" class="form-label">Minimal
                                                                    Stok</label>
                                                                <input type="number" class="form-control"
                                                                    id="minimal_stok" name="minimal_stok"
                                                                    value="{{ $item->minimal_stok }}"
                                                                    min="0" readonly>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="harga_satuan" class="form-label">Harga
                                                                    Satuan</label>
                                                                <input type="number" class="form-control"
                                                                    id="harga_satuan" name="harga_satuan"
                                                                    value="{{ $item->harga_satuan }}"
                                                                    min="0" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="id_jurusan"
                                                                    class="form-label">Jurusan</label>
                                                                <select name="id_jurusan" class="form-control"
                                                                    required>
                                                                    <option disabled selected>Pilih Jurusan</option>
                                                                    @foreach ($jurusan as $j)
                                                                        <option value="{{ $j->id }}"
                                                                            {{ $item->id_jurusan == $j->id ? 'selected' : '' }}>
                                                                            {{ $j->nama_jurusan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer mt-4">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Movement Table -->
                <div class="table-container movement-table" id="movementTableWrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Bahan</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Referensi</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stoks as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->bahan->nama_bahan }}</td>
                                    <td><span class="status-badge status-masuk">{{ $item->jenis }}</span></td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->reference }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Tombol tab
            const inventoryTab = document.getElementById('inventoryTab');
            const movementTab = document.getElementById('movementTab');

            // Konten tabel
            const inventoryTable = document.getElementById('inventoryTableWrapper');
            const movementTable = document.getElementById('movementTableWrapper');

            if (tab === 'inventory') {
                inventoryTab.classList.add('active');
                movementTab.classList.remove('active');

                inventoryTable.style.display = 'block';
                movementTable.style.display = 'none';
            } else if (tab === 'movement') {
                movementTab.classList.add('active');
                inventoryTab.classList.remove('active');

                movementTable.style.display = 'block';
                inventoryTable.style.display = 'none';
            }
        }

        // Saat halaman pertama dimuat, tampilkan tab inventory
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('inventory');
        });
    </script>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
</body>

</html>
