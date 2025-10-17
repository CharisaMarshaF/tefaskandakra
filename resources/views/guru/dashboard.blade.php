<x-layout>
    <h1 class="page-title">DASHBOARD</h1>

    <!-- Top Cards Grid -->
    <div class="dashboard-grid">
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-avatar"></div>
            <div class="profile-name">{{ Auth::user()->guru->nama }}</div>
            <div class="profile-role">{{ Auth::user()->role->name }}</div>
            <div class="profile-nip">NIP : {{ Auth::user()->guru->nip }}</div>
        </div>

        <!-- Stats Cards -->
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-content">
                <h3>10</h3>
                <p>Siswa Bimbingan</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="stat-content">
                <h3>9</h3>
                <p>Proyek Aktif</p>
            </div>
        </div>
    </div>

    <!-- Bottom Grid -->
    <div class="dashboard-grid">
        <!-- Notifications Card -->
        <div class="notifications-card">
            <h3 class="notifications-title">Notifikasi Terbaru</h3>
            <div class="notification-item">
                <div class="notification-dot"></div>
                <div class="notification-content">
                    <p class="notification-text">
                        Project Tefa terbaru
                    </p>
                    <p class="notification-time">2 menit lalu</p>
                </div>
                <button class="notification-action">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <div class="notification-item">
                <div class="notification-dot"></div>
                <div class="notification-content">
                    <p class="notification-text">
                        Update Tugas Tefa
                    </p>
                    <p class="notification-time">25 menit lalu</p>
                </div>
                <button class="notification-action">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <!-- Project Cards -->
        <div class="project-card">
            <h4 class="project-title">Proyek Tefa Terbaru</h4>
            <p class="project-description">
                Sistem Informasi Perpustakaan Digital<br />
                Membuat sistem perpustakaan digital dengan finetik
                online, peminjaman digital dan pengembalian
                otomatis.
            </p>
            <div class="project-meta">Deadline: 3 hari tersisa</div>
        </div>

        <div class="project-card">
            <h4 class="project-title">
                Sistem Informasi Perpustakaan Digital
            </h4>
            <p class="project-description">
                Membuat sistem perpustakaan digital dengan finetik
                online, peminjaman digital dan pengembalian
                otomatis.
            </p>
            <div class="project-meta">Deadline: 5 hari tersisa</div>
        </div>
    </div>

    <!-- Apps Section -->
    <div class="apps-section">
        <div class="apps-grid">
            <div class="app-card">
                <div class="app-info">
                    <h6>Aplikasi Kasir Toko Modern</h6>
                    <p>Oleh: App Developer Team</p>
                    <div class="app-progress">Progress: 65%</div>
                </div>
                <div class="app-actions">
                    <button class="btn-view">👁</button>
                    <button class="btn-download">⬇</button>
                </div>
            </div>

            <div class="app-card">
                <div class="app-info">
                    <h6>Aplikasi Kasir Toko Modern</h6>
                    <p>Oleh: App Developer Team</p>
                    <div class="app-progress">Progress: 45%</div>
                </div>
                <div class="app-actions">
                    <button class="btn-view">👁</button>
                    <button class="btn-download">⬇</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
