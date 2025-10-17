<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Teaching Factory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('guru/styles.css') }}">
    @stack('styles')
</head>

<body class="flex min-h-screen">
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-section">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="logo-text">
                    <div class="logo-main">Teaching Factory</div>
                    <div class="logo-sub">SISTEM MANAJEMEN</div>
                </div>
            </a>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('dashboard.guru') }}" class="menu-item {{ request()->is('dashboard-guru') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <a href="{{ route('kelola') }}" class="menu-item {{ request()->is('kelola') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Kelola
            </a>
            {{-- <a href="{{ route('nilaiguru') }}" class="menu-item {{ request()->is('nilai') ? 'active' : '' }}">
                <i class="bi bi-star-fill"></i>
                Nilai
            </a> --}}
            <a href="{{ route('prosesProduksi') }}" class="menu-item {{ request()->is('prosesProduksi') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                Produksi
            </a>
            <a href="{{ route('project-tefa') }}" class="menu-item {{ request()->is('project-tefa') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                Project TEFA
            </a>
        </nav>
    </div>

    <main class="flex-1 p-6 md:ml-72 transition-all">
        <nav class="top-navbar">
            <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="search-container">
                <input type="text" placeholder="Search here...">
                <i class="bi bi-search search-icon"></i>
            </div>

           <div class="user-section">
    <i class="bi bi-bell notification-icon"></i>

    <div class="user-profile position-relative" id="userProfile">
        <div class="user-avatar"></div>

        <div class="user-info">
            <h6>{{ Auth::user()->guru->nama }}</h6>
            <small>{{ Auth::user()->role->name ?? 'Role' }}</small>
        </div>
        <i class="bi bi-chevron-down ms-2"></i>

        <!-- Dropdown Logout -->
        <div id="logoutDropdown"
            style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 10px; min-width: 150px; z-index: 1000;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

        </nav>
        <div class="content-wrapper">
            {{ $slot }}
        </div>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @stack('scripts')
    <script src="{{ asset('guru/dist.js') }}"></script>

    <script>
            document.getElementById('userProfile').addEventListener('click', function () {
        const dropdown = document.getElementById('logoutDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Tutup dropdown kalau klik di luar area
    document.addEventListener('click', function (event) {
        const profile = document.getElementById('userProfile');
        const dropdown = document.getElementById('logoutDropdown');
        if (!profile.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
    </script>
</body>

</html>
