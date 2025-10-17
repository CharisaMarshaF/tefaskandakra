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
                <!-- Tombol Tambah Pengiriman -->
                <div class="header-buttons">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengirimanModal">
                        <i class="bi bi-plus"></i> Tambah Pengiriman
                    </button>
                </div>

                <!-- Modal Tambah Pengiriman -->
                <div class="modal fade" id="tambahPengirimanModal" tabindex="-1"
                    aria-labelledby="tambahPengirimanModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('pengiriman.store') }}" method="POST">
                                @csrf
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="tambahPengirimanModalLabel">Tambah Pengiriman</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <!-- ID Order -->
                                        <div class="col-md-6">
                                            <label for="id_order" class="form-label">Order</label>
                                            <select name="id_order" id="id_order" class="form-select">
                                                <option value="">Pilih Order</option>
                                                @foreach ($order as $item)
                                                    <option value="{{ $item->id }}">{{ $item->order_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Courier -->
                                        <div class="col-md-6">
                                            <label for="courier" class="form-label">Kurir</label>
                                            <input type="text" class="form-control" id="courier" name="courier"
                                                placeholder="Contoh: JNE, J&T, TIKI">
                                        </div>

                                        <!-- Tracking No -->
                                        <div class="col-md-6">
                                            <label for="tracking_no" class="form-label">Nomor Resi</label>
                                            <input type="text" class="form-control" id="tracking_no "
                                                name="tracking_no">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="packed">Packed</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="delivered">Delivered</option>
                                            </select>
                                        </div>

                                        <!-- Packed By -->
                                        <div class="col-md-6">
                                            <label for="packed_by" class="form-label">Dikemas Oleh</label>
                                            <input type="text" class="form-control" id="packed_by" name="packed_by">
                                        </div>

                                        <!-- Shipped At -->
                                        <div class="col-md-6">
                                            <label for="shipped_at" class="form-label">Tanggal Dikirim</label>
                                            <input type="datetime-local" class="form-control" id="shipped_at"
                                                name="shipped_at">
                                        </div>

                                        <!-- Delivered At -->
                                        <div class="col-md-6">
                                            <label for="delivered_at" class="form-label">Tanggal Diterima</label>
                                            <input type="datetime-local" class="form-control" id="delivered_at"
                                                name="delivered_at">
                                        </div>
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
            <div class="filter-bar">
                <div class="filter-tabs">
                    <button class="filter-tab active" id="allProductionTab" onclick="switchProductionTab('all')">
                        Semua Produksi
                    </button>
                    <button class="filter-tab" id="inProgressTab" onclick="switchProductionTab('kurir')">
                        Kurir
                    </button>
                </div>

                <div class="filter-controls">
                    <input type="text" placeholder="Cari produk atau order..." id="searchProduction">
                    <select id="statusFilter">
                        <option>Semua Status</option>
                        <option>Antrian</option>
                        <option>Produksi</option>
                        <option>Selesai</option>
                    </select>
                    <select id="typeFilter">
                        <option>Semua Tipe</option>
                        <option>Tekstil</option>
                        <option>Elektronik</option>
                        <option>Mekanik</option>
                    </select>
                    <div></div>
                </div>
            </div>

            <!-- SEMUA PRODUKSI -->
            <div id="tableAll" class="inventory-section" style="margin-top: 25px;">
                <div class="inventory-header">
                    <h5>Daftar Semua Pengiriman</h5>
                    <p>Semua data pengiriman produk dengan status apapun</p>
                </div>

                <div class="table-container">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Courier</th>
                                <th>Tracking No</th>
                                <th>Status</th>
                                <th>Packed By</th>
                                <th>Shipped at</th>
                                <th>Delivered at</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipment as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->order->order_no }}</td>
                                    <td>{{ $item->courier }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->shipped_at }}</td>
                                    <td>{{ $item->delivered_at }}</td>
                                    <td class="action-cell">
                                        <button class="action-menu" onclick="toggleDropdown(this)">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <div class="action-dropdown">
                                            <a href="#" class="dropdown-item edit"><i class="bi bi-truck"></i>
                                                Kirim</a>
                                            <a href="#" class="dropdown-item delete"><i
                                                    class="bi bi-x-circle"></i> Batal</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB KURIR -->
            <div id="tableKurir" class="inventory-section d-none" style="margin-top: 25px;">
                <div class="container mt-4">
                    <!-- Card 1 -->
                    @foreach ($shipment as $item)
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-semibold mb-1">{{ $item->order->order_no }} <span
                                            class="fw-normal text-secondary"></h6>
                                    <p class="mb-0 text-muted small">{{ $item->courier }}
                                        <strong>{{ $item->tracking_no }}</strong></p>
                                    <p class="mb-0 text-muted small">{{ $item->order->shipping_address }}</p>
                                    <p class="mb-0 text-secondary small">Estimasi: {{ $item->delivered_at }}</p>
                                </div>
                                <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2">
                                    {{ $item->status }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- TAB RIWAYAT SELESAIAN -->
            <div id="tableCompleted" class="inventory-section d-none" style="margin-top: 25px;">
                <div class="inventory-header">
                    <h5>Riwayat Pengiriman Selesai</h5>
                    <p>Data pengiriman yang sudah diterima pelanggan</p>
                </div>

                <div class="table-container">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Courier</th>
                                <th>Tracking No</th>
                                <th>Delivered At</th>
                                <th>Packed By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipment->where('status', 'delivered') as $item)
                                <tr>
                                    <td>{{ $item->order->order_no }}</td>
                                    <td>{{ $item->courier }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->delivered_at }}</td>
                                    <td>{{ $item->user->username }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                // Fungsi untuk ganti tab tabel
                function switchProductionTab(tab) {
                    // Hilangkan semua aktif
                    document.querySelectorAll('.filter-tab').forEach(btn => btn.classList.remove('active'));
                    document.getElementById('tableAll').classList.add('d-none');
                    document.getElementById('tableKurir').classList.add('d-none');
                    document.getElementById('tableCompleted').classList.add('d-none');

                    // Tampilkan tabel sesuai tab
                    if (tab === 'all') {
                        document.getElementById('allProductionTab').classList.add('active');
                        document.getElementById('tableAll').classList.remove('d-none');
                    } else if (tab === 'kurir') {
                        document.getElementById('inProgressTab').classList.add('active');
                        document.getElementById('tableKurir').classList.remove('d-none');
                    } else if (tab === 'completed') {
                        document.getElementById('completedTab').classList.add('active');
                        document.getElementById('tableCompleted').classList.remove('d-none');
                    }
                }
            </script>

        </div>
    </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
</body>

</html>
