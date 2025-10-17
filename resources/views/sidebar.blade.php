 <div class="sidebar" id="sidebar">
        <div class="logo-section">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="logo-text">
                    <div class="logo-main">Trading Factory</div>
                    <div class="logo-sub">SISTEM MANAJEMEN</div>
                </div>
            </a>
        </div>
        <nav class="sidebar-menu ">
            <a href="dasboard.html" class="menu-item">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <a href="/produk" class="menu-item {{ request()->is('produk') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                Produk TEFA
            </a>
            <a href="/stok" class="menu-item {{ request()->is('stok') ? 'active' : '' }}">
                <i class="bi bi-archive-fill"></i>
                Stok Bahan
            </a>
            <a href="/pemesanan" class="menu-item {{ request()->is('pemesanan') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                Pemesanan
            </a>
            <a href="/pembayaran" class="menu-item {{ request()->is('pembayaran') ? 'active' : '' }}">
                <i class="bi bi-credit-card-fill"></i>
                Pembayaran
            </a>
            <a href="/produksi" class="menu-item {{ request()->is('produksi') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                Produksi
            </a>
            <a href="/pengiriman" class="menu-item {{ request()->is('pengiriman') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                Pengiriman
            </a>
            <a href="/sigur" class="menu-item {{ request()->is('sigur') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Siswa & Guru
            </a>
        </nav>
    </div>
