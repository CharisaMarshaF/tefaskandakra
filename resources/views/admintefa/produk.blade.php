<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trading Factory - Manajemen Stok Barang</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles.css" />
</head>

<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    @include('../sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="search-container">
                <input type="text" placeholder="search here..." />
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
                    <h2>Manajemen Produk TEFA</h2>
                    <p>Kelola katalog produk TEFA</p>
                </div>
                <div class="header-buttons">
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-download"></i>
                        Export Katalog
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="bi bi-plus"></i>
                        Tambah Produk
                    </button>
                </div>
            </div>
            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">
                                Tambah Produk Baru
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="kode_produk">Kode Produk</label>
                                    <input type="text" id="kode_produk" name="kode_produk"
                                        value="{{ $kode_produk ?? '' }}" class="form-control" readonly="readonly">
                                </div>

                                <div class="mb-3">
                                    <label for="productName" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="productName" name="nama_produk"
                                        required="required" />
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Jurusan</label>
                                    <select class="form-select" id="productJurusan" name="id_jurusan"
                                        required="required">
                                        <option value="" disabled="disabled" selected="selected">Pilih Jurusan
                                        </option>
                                        @foreach ($jurusans as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label">Kategori</label>
                                    <select class="form-select" id="productCategory" name="kategori"
                                        required="required">
                                        <option value="" disabled="disabled" selected="selected">Pilih Kategori
                                        </option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Tekstil">Tekstil</option>
                                        <option value="Kerajinan">Kerajinan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="productPrice" name="harga"
                                        required="required" />
                                </div>
                                <div class="mb-3">
                                    <label for="productStock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="productStock" name="stok"
                                        required="required" />
                                </div>
                                <div class="mb-3">
                                    <label for="productUnit" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="productUnit" name="satuan"
                                        required="required" />
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Gambar Produk</label>
                                    <input class="form-control" type="file" id="productImage" name="foto[]"
                                        multiple="multiple" />
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="productDescription" name="deskripsi" rows="3" required="required"></textarea>
                                </div>
                                <input type="hidden" name="status" value="aktif" />
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Tutup
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Produk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-box"></i>
                    </div>
                    <div class="stat-value">8</div>
                    <p class="stat-label">Total Produk</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-value">5</div>
                    <p class="stat-label">Produk Aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value">1</div>
                    <p class="stat-label">Stok Habis</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="stat-value">4.7</div>
                    <p class="stat-label">Rating Rata-rata</p>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-bar">
                <div class="filter-controls" style="grid-template-columns: 2fr 1fr">
                    <input type="text" placeholder="Cari produk..." id="searchProducts" />
                    <select id="categoryFilter">
                        <option>Semua Kategori</option>
                        <option>Furniture</option>
                        <option>Elektronik</option>
                        <option>Tekstil</option>
                        <option>Kerajinan</option>
                    </select>
                </div>
            </div>
            <!-- Container Grid -->
            <div class="product-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                @foreach ($produk as $p)
                    <!-- Product Card -->
                    <div class="product-card cursor-pointer"
                        style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:1px solid #f1f5f9; transition:all 0.3s ease;">

                        <div style="padding:15px">
                            <!-- Nama & Harga -->
                            <h6 style="font-weight:600; margin:0 0 5px 0; color:#1a202c; font-size:14px;">
                                {{ $p->nama_produk }}</h6>
                            <div style="font-size:18px; font-weight:700; color:#1a202c; margin-bottom:10px;">Rp.
                                {{ number_format($p->harga, 0, ',', '.') }}</div>

                            <!-- Foto Produk -->
@if ($p->fotos && $p->fotos->count() > 0) <!-- Check if fotos relationship exists and has photos -->
    <div class="product-gallery">
        <!-- Main image -->
        <div class="main-image" style="text-align:center; margin-bottom:10px;" data-bs-toggle="modal" data-bs-target="#modal-{{ $p->id }}">
            <img id="mainImage-{{ $p->id }}"
                src="{{ asset('storage/' . $p->fotos->first()->foto) }}"
                style="width:100%; height:200px; object-fit:contain; border-radius:5px;">
        </div>

        <!-- Thumbnail images -->
        <div class="thumbnails">
            @foreach ($p->fotos as $foto)
                <img src="{{ asset('storage/' . $foto->foto) }}" class="img-thumbnail"
                    style="width:80px; height:80px; cursor:pointer;"
                    onclick="document.getElementById('modal-main-{{ $p->id }}').src='{{ asset('storage/' . $foto->foto) }}'">
            @endforeach
        </div>
    </div>
@else
    <!-- Fallback when no photos exist -->
    <div class="product-gallery">
        <div class="main-image" style="text-align:center; margin-bottom:10px;">
            <img id="mainImage-{{ $p->id }}"
                src="{{ asset('images/no-image.png') }}"  <!-- Placeholder image -->
                style="width:100%; height:200px; object-fit:contain; border-radius:5px;">
        </div>
        <span>No images available</span> <!-- Display a message if no images are available -->
    </div>
@endif

                            <!-- Status & Action -->
                            <div
                                style="display:flex; justify-content:space-between; align-items:center; margin-top:10px;">
                                <span style="font-size:11px; padding:3px 8px; background:#d1fae5; border-radius:4px;">
                                    {{ $p->stok > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                                </span>
                                <div style="display:flex; gap:5px;">
                                    <a href="{{ route('produk.edit', $p->id) }}"
                                        style="width:24px; height:24px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:4px; display:flex; align-items:center; justify-content:center;">
                                        <i class="bi bi-pencil" style="font-size:10px; color:#6c757d;"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST"
                                        style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="width:24px; height:24px; background:#f1f5f9; border:1px solid #e2e8f0; border-radius:4px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-trash" style="font-size:10px; color:#6c757d;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Detail -->
                @endforeach
            </div>
            @foreach ($produk as $p)
                <div class="modal fade" id="modal-{{ $p->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $p->nama_produk }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar besar -->
<img id="modal-main-{{ $p->id }}"
    src="{{ $p->fotos->isEmpty() ? asset('images/no-image.png') : asset('storage/' . $p->fotos->first()->foto) }}"
    class="img-fluid mb-3" alt="Product Image">

<!-- Thumbnail Images -->
<div class="d-flex gap-2 overflow-auto mb-3">
    @foreach ($p->fotos as $foto)
        <img src="{{ asset('storage/' . $foto->foto) }}" class="img-thumbnail"
            style="width:80px; height:80px; cursor:pointer;"
            onclick="document.getElementById('modal-main-{{ $p->id }}').src='{{ asset('storage/' . $foto->foto) }}'">
    @endforeach
</div>


                                <!-- Informasi Produk -->
                                <p><strong>Deskripsi:</strong> {{ $p->deskripsi }}</p>
                                <p><strong>Stok:</strong> <span>
                                        {{ $p->stok }}</span></p>
                                <p><strong>Satuan:</strong> {{ $p->satuan }}</p>
                                <p><strong>Kode Produk:</strong> {{ $p->kode_produk }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist.js"></script>
</body>

</html>
