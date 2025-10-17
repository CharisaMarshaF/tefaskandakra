<style>
    .sidebar {

        z-index: 1020;
    }
</style>

<div class="sidebar d-none d-md-flex flex-column p-4 vh-100 position-fixed top-0 start-0">
    <div class="mb-5 text-center">
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
    <ul class="nav flex-column mt-2">
        <li class="nav-item mb-2">
            <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }} py-3 px-4 d-flex align-items-center fw-medium">
                <i class="fa-solid fa-home me-3 fs-5"></i> Dashboard
            </a>
        </li>
        {{-- <li class="nav-item mb-2">
            <a href="{{ route('siswa.kelas_industri.index') }}" class="nav-link py-3 px-4 d-flex align-items-center fw-medium">
                <i class="fa-solid fa-building me-3 fs-5"></i> Kelas Industri
            </a>
        </li> --}}
        <li class="nav-item mb-2">
            <a href="{{ route('siswa.projects') }}" class="nav-link {{ request()->routeIs('siswa.projects') ? 'active' : '' }} py-3 px-4 d-flex align-items-center fw-medium">
                <i class="fa-solid fa-gears me-3 fs-5"></i> Produksi TEFA
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('siswa.project_progress.index') }}" class="nav-link {{ request()->routeIs('siswa.project_progress.index') ? 'active' : '' }} py-3 px-4 d-flex align-items-center fw-medium">
                <i class="fa-solid fa-chart-bar me-3 fs-5"></i> Laporan Progres
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('siswa.nilai_project.index') }}" class="nav-link {{ request()->routeIs('siswa.nilai_project.index') ? 'active' : '' }} py-3 px-4 d-flex align-items-center fw-medium">
                <i class="fa-solid fa-star me-3 fs-5"></i> Lihat Nilai
            </a>
            </a>
        </li>
    </ul>
</div>
  