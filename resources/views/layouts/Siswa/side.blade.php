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

    <nav class="sidebar-menu">

        {{-- Jika role adalah siswa --}}
        @if(Auth::check() && Auth::user()->id_role == '6')
            <a href="/dashboard-siswa" class="menu-item {{ request()->is('dashboard-siswa') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <a href="/kelasindustri" class="menu-item {{ request()->is('kelasindustri') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Kelas Industri
            </a>
            <a href="/lihatnilai" class="menu-item {{ request()->is('lihatnilai') ? 'active' : '' }}">
                <i class="bi bi-star-fill"></i>
                Nilai
            </a>
            <a href="/laporan" class="menu-item {{ request()->is('laporan') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                Laporan
            </a>
            <a href="/produksi" class="menu-item {{ request()->is('produksi') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                Produksi
            </a>

        {{-- Jika role adalah orang_tua --}}
        @elseif(Auth::check() && Auth::user()->id_role == '7')
            <a href="/dashboard-orang-tua" class="menu-item {{ request()->is('dashboard-orang-tua') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <a href="/nilai" class="menu-item {{ request()->is('nilai') ? 'active' : '' }}">
                <i class="bi bi-pencil-square"></i>
                Nilai & Progress
            </a>
            <a href="/surat" class="menu-item {{ request()->is('surat') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                Surat Pernyataan
            </a>
            <a href="/riwayat" class="menu-item {{ request()->is('riwayat') ? 'active' : '' }}">
                <i class="bi bi-folder"></i>
                Riwayat Project
            </a>
        @endif

    </nav>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
