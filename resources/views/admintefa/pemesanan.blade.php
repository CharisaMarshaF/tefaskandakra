e
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
                    <h2>Manajemen Pesanan</h2>
                    <p>Kelola pesanan online dan offline TEFA</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-cart-check"></i>
                    </div>
                    <div class="stat-value">5</div>
                    <p class="stat-label">Total Pesanan</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="stat-value">3</div>
                    <p class="stat-label">Pesanan Online</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="bi bi-shop"></i>
                    </div>
                    <div class="stat-value">2</div>
                    <p class="stat-label">Pesanan Offline</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-value">1</div>
                    <p class="stat-label">Pending Pembayaran</p>
                </div>
            </div>

            <!-- Critical Alert -->
            <div class="critical-alert">
                <i class="bi bi-exclamation-triangle-fill alert-icon"></i>
                <p class="alert-text">
                    <strong>Perhatian!</strong>
                    Ada 1 pesanan yang menunggu konfirmasi pembayaran dari customer
                </p>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-tabs">
                    <button class="filter-tab active" id="allOrdersTab" onclick="switchOrderTab('all')">Semua
                        Pesanan</button>
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

            <!-- Order Table -->
            <div class="inventory-section">
                <div class="inventory-header">
                    <h5 id="tableTitle">Daftar Pesanan</h5>
                    <p id="tableSubtitle">Semua pesanan yang masuk ke sistem TEFA</p>
                </div>

                <!-- Orders Table -->
                <div class="table-container inventory-table-wrapper" id="ordersTableWrapper">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tipe</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->order->order_no }}</td>
                                    <td>{{ $item->order->user->username }}</td>
                                    <td>{{ $item->produk->nama_produk }} ({{ $item->qty }}) </td>
                                    <td class="price-cell">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td><span class="status-badge status-processing">{{ $item->order->status }}</span>
                                    </td>
                                    <td><span class="status-badge status-online">Online</span></td>
                                    <td>2025-01-20</td>
                                    <td>
                                        @if ($item->order->status == 'diproses')
                                            <form action="{{ route('dikirim', $item->id_order) }}" method="POST"
                                                onclick="return confirm('Kirim Pesanan?')">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="order_no"
                                                    value="{{ $item->order->order_no }}">
                                                <input type="hidden" name="id_user"
                                                    value="{{ $item->order->id_user }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $item->order->total }}">
                                                <input type="hidden" name="shipping_address"
                                                    value="{{ $item->order->shipping_address }}">
                                                <input type="hidden" name="status" value="dikirim">
                                                <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                                            </form>
                                        @elseif ($item->order->status == 'pending')
                                            <form action="{{ route('konfirmasi', $item->id_order) }}" method="POST"
                                                onclick="return confirm('Proses pesanan?')">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="order_no"
                                                    value="{{ $item->order->order_no }}">
                                                <input type="hidden" name="id_user"
                                                    value="{{ $item->order->id_user }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $item->order->total }}">
                                                <input type="hidden" name="shipping_address"
                                                    value="{{ $item->order->shipping_address }}">
                                                <input type="hidden" name="status" value="diproses">
                                                <button type="submit" class="btn btn-sm btn-warning">Proses</button>
                                            </form>
                                        @elseif ($item->order->status == 'dikirim')
                                            <form action="{{ route('selesai', $item->id_order) }}" method="POST"
                                                onclick="return confirm('Tutup Pesanan?')">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="order_no"
                                                    value="{{ $item->order->order_no }}">
                                                <input type="hidden" name="id_user"
                                                    value="{{ $item->order->id_user }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $item->order->total }}">
                                                <input type="hidden" name="shipping_address"
                                                    value="{{ $item->order->shipping_address }}">
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                            </form>
                                        @elseif ($item->order->status == 'selesai')
                                        <div class="btn btn-sm btn-success">Pesanan Selesai</div>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dist.js') }}"></script>
</body>

</html>
