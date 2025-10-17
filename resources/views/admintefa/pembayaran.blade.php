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
                    <h2>Manajemen Pembayaran</h2>
                    <p>Verifikasi dan konfirmasi pembayaran pesanan TEFA</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row mb-4">
                <div class="stat-card" onclick="filterTable('pending')">
                    <div class="stat-icon red"><i class="bi bi-clock-history"></i></div>
                    <div class="stat-value">{{ $pembayarans->where('status', 'pending')->count() }}</div>
                    <p class="stat-label">Pending Verifikasi</p>
                </div>
                <div class="stat-card" onclick="filterTable('diterima')">
                    <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
                    <div class="stat-value">{{ $pembayarans->where('status', 'diterima')->count() }}</div>
                    <p class="stat-label">Terverifikasi</p>
                </div>
                <div class="stat-card" onclick="filterTable('ditolak')">
                    <div class="stat-icon purple"><i class="bi bi-x-circle"></i></div>
                    <div class="stat-value">{{ $pembayarans->where('status', 'ditolak')->count() }}</div>
                    <p class="stat-label">Ditolak</p>
                </div>
                <div class="stat-card" onclick="filterTable('all')">
                    <div class="stat-icon"><i class="bi bi-list-ul"></i></div>
                    <div class="stat-value">{{ $pembayarans->count() }}</div>
                    <p class="stat-label">Semua</p>
                </div>
            </div>

            <!-- Alert -->
            <div class="critical-alert"
                style="background-color: #fefce8; border-color: #fef08a; border-left-color: #f59e0b;">
                <i class="bi bi-exclamation-triangle-fill alert-icon" style="color: #f59e0b;"></i>
                <p class="alert-text" style="color: #92400e;">
                    <strong>Perhatian!</strong>
                    Ada 2 pembayaran yang belum diverifikasi dengan atas nama pelanggan dibawah
                </p>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <!-- Tabs -->
                <div class="payment-tabs">
                    <button class="filter-tab active" id="allPaymentsTab" onclick="switchPaymentTab('all')">
                        Semua Pembayaran
                    </button>
                    <button class="filter-tab" id="pendingPaymentsTab" onclick="switchPaymentTab('pending')">
                        Pending
                    </button>
                    <button class="filter-tab" id="verifiedPaymentsTab" onclick="switchPaymentTab('verified')">
                        Terverifikasi
                    </button>
                    <button class="filter-tab" id="rejectedPaymentsTab" onclick="switchPaymentTab('rejected')">
                        Ditolak
                    </button>
                </div>
                <div class="filter-controls">
                    <input type="text" placeholder="Cari customer atau order ID..." id="searchPayments">
                    <select id="statusFilter">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Verified</option>
                        <option>Rejected</option>
                    </select>
                    <select id="methodFilter">
                        <option>Semua Metode</option>
                        <option>Bank Transfer</option>
                        <option>E-Wallet</option>
                        <option>Cash</option>
                    </select>
                    <div></div>
                </div>
            </div>

            <div class="inventory-section">
                <div class="inventory-header">
                    <h5 id="tableTitle">Daftar Pembayaran</h5>
                    <p id="tableSubtitle">Semua pembayaran yang masuk ke sistem TEFA</p>
                </div>

                <div class="table-container inventory-table-wrapper" id="paymentsTableWrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Waktu Submit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayarans as $item)
                                <tr data-status="{{ strtolower($item->status) }}">
                                    <td class="fw-semibold">{{ $item->order->order_no }}</td>
                                    <td>{{ $item->order->user->username }} <br><small class="text-muted">
                                            {{ $item->order->items->qty }} pcs</small>
                                    </td>
                                    <td class="price-cell">Rp{{ number_format($item->order->total, 0, ',', '.') }}</td>
                                    <td><span class="status-badge status-transfer">{{ $item->metode }}</span></td>
                                    <td>
                                        <span
                                            class="status-badge
                                {{ $item->status == 'diterima'
                                    ? 'bg-success text-white'
                                    : ($item->status == 'ditolak'
                                        ? 'bg-danger text-white'
                                        : 'bg-warning text-dark') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="action-cell">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">⋮</button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('konfirmasi', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="dropdown-item text-success" type="submit">✅
                                                            Konfirmasi</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('tolak', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="dropdown-item text-danger" type="submit">❌
                                                            Tolak</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                function filterTable(status) {
                    let rows = document.querySelectorAll(".inventory-table tbody tr");
                    rows.forEach(row => {
                        let rowStatus = row.getAttribute("data-status");
                        if (status === "all" || rowStatus === status) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                }

                function switchPaymentTab(status) {
                    // reset semua tab
                    document.querySelectorAll('.filter-tab').forEach(btn => btn.classList.remove('active'));

                    // mapping status ke id tab
                    if (status === 'all') document.getElementById("allPaymentsTab").classList.add("active");
                    if (status === 'pending') document.getElementById("pendingPaymentsTab").classList.add("active");
                    if (status === 'verified') document.getElementById("verifiedPaymentsTab").classList.add("active");
                    if (status === 'rejected') document.getElementById("rejectedPaymentsTab").classList.add("active");

                    // mapping status ke data-status di tabel
                    if (status === 'verified') status = 'diterima';
                    if (status === 'rejected') status = 'ditolak';

                    filterTable(status);
                }
            </script>


        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>
