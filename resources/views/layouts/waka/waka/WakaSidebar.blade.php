<div class="sidebar d-none d-md-flex flex-column p-4 vh-100 position-fixed top-0 start-0">
    <div class="mb-5 text-center">
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
    <ul class="nav flex-column mt-2">
        <li class="nav-item mb-2">
            <a href="{{ url('/waka/dashboard') }}"
                class="nav-link py-3 px-4 d-flex align-items-center fw-medium {{ request()->is('/dashboard.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high me-3 fs-5"></i> Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('jadwal-kelas-industri.index') }}"
                class="nav-link py-3 px-4 d-flex align-items-center fw-medium {{ request()->routeIs('jadwal-kelas-industri.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users me-3 fs-5"></i> Kelas Industri
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('jadwal-tefa.index') }}"
                class="nav-link py-3 px-4 d-flex align-items-center fw-medium {{ request()->routeIs('jadwal-tefa.*') ? 'active' : '' }}">
                <i class="fa-solid fa-cogs me-3 fs-5"></i> Produksi TEFA
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('nilai.index') }}"
                class="nav-link py-3 px-4 d-flex align-items-center fw-medium {{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line me-3 fs-5"></i> Nilai Project
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('sertifikat.index') }}"
                class="nav-link py-3 px-4 d-flex align-items-center fw-medium {{ request()->routeIs('sertifikat.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice me-3 fs-5"></i> Sertifikat
            </a>
        </li>
    </ul>

</div>
