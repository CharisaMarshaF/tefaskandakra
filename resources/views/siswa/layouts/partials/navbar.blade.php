<nav class="navbar navbar-expand-lg bg-white rounded-4 shadow-sm mb-4">
    <div class="container-fluid">
        <button class="btn d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse"
            aria-controls="sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-5"></i>
        </button>
        <div class="input-group me-3 d-none d-md-flex" style="max-width: 400px;">
            <span class="input-group-text bg-transparent border-end-0"><i
                    class="fa-solid fa-magnifying-glass text-muted"></i></span>
            <input type="text" class="form-control border-start-0 custom-input" placeholder="Search here ...">
        </div>
        <div class="d-flex align-items-center ms-auto">
            <div class="position-relative me-4">
                <i class="fa-solid fa-bell fs-5 text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.6rem;">1</span>
            </div>
            {{-- Tambahkan bagian dropdown yang dimodifikasi di sini atau di layout utama --}}
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Menggunakan data siswa yang dikirimkan dari controller --}}
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://i.ibb.co/L8y2wVp/avatar.png' }}"
                        alt="User Avatar" class="rounded-circle me-2" width="40" height="40">
                    <div class="d-none d-md-block">
                        <div class="fw-semibold text-dark">{{ $siswa->nama_lengkap }}</div>
                        {{-- <small class="text-muted">{{ Auth::user()->role ?? 'Siswa' }}</small> --}}
                    </div>
                    <i class="fa-solid fa-chevron-down ms-2 text-muted"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        {{-- Menggunakan form untuk logout yang aman --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</nav>