<div class="topbar d-flex justify-content-between align-items-center">
    <span>Selamat Datang Di Skanda store.</span>
    <div>
        Follow us:
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-pinterest"></i></a>
        <a href="#"><i class="fab fa-reddit"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>

<nav class="main-navbar navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('img/logo_tefa.png') }}" alt="Logo" height="40" class="me-2">
        </a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('customer.profil_tefa') }}">Profile</a></li>
                <!-- Dropdown Jurusan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Jurusan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('customer.jurusan_mesin') }}">Mesin</a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.jurusan_tekstil') }}">Tekstil</a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.jurusan_oto') }}">Ototronik</a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.jurusan_rpl') }}">RPL</a></li>
                    </ul>
                </li>

                <!-- Dropdown Produk -->
                
                <li class="nav-item"><a class="nav-link" href="{{ route('customer.produk') }}">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('customer.kontak') }}">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('customer.mitra') }}">Mitra</a></li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('customer.keranjang') }}" class="icon-btn"><i class="fas fa-shopping-cart"></i></a>
                <a href="{{ route('customer.akun') }}" class="icon-btn"><i class="far fa-user"></i></a>
            </div>
        </div>
    </div>
</nav>

<div class="subbar shadow-sm">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 mb-2 mb-md-0">
                <a href="{{ route('lacak.pesanan') }}" style="text-decoration: none; color: black;">
                    <span class="me-4"><i class="fas fa-map-marker-alt"></i> Lacak Pesanan</span>
                </a>
                <a href="{{ route('customer.customer_service') }}" style="text-decoration: none; color: black;">
                    <span><i class="fas fa-headphones"></i> Dukungan Pelanggan</span>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <form class="d-flex search-box" action="{{ route('customer.search') }}" method="GET">
                    <input class="form-control py-2" name="q" type="search" placeholder="Cari produk ....." aria-label="Search" value="{{ request('q') }}">
                </form>
                
            </div>
        </div>
    </div>
</div>
