<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Teaching Factory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>

    <div class="container-fluid" id="app-container">
        <div id="register-page" class="login-page vh-100 d-flex justify-content-center align-items-center">
            <div class="login-card row g-0">
                <div class="left-panel col-md-6 p-5 text-white d-flex flex-column justify-content-center text-center text-md-start">
                    <h1 class="display-5 fw-bold mb-3">Selamat Bergabung!</h1>
                    <p class="fs-5 fw-medium mb-3">TEFA SMK N 2 Karanganyar</p>
                    <p class="mb-4">Bergabunglah dengan kami untuk menikmati berbagai fitur di situs ini.</p>
<a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-5 py-2 fw-semibold align-self-center align-self-md-start">
    Login
</a>
                </div>
                <div class="right-panel col-md-6 p-5 bg-white d-flex flex-column justify-content-center">
                    <h2 class="display-6 fw-bold mb-2">Register</h2>
                    <p class="text-secondary mb-4">Masukkan detail Anda untuk melanjutkan pendaftaran</p>
                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-user text-secondary"></i></span>
                                <input type="text" class="form-control custom-input border-start-0" name="username" value="{{ old('username') }}" placeholder="Username">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-envelope text-secondary"></i></span>
                                <input type="email" class="form-control custom-input border-start-0" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-phone text-secondary"></i></span>
                                <input type="text" class="form-control custom-input border-start-0" name="phone" value="{{ old('phone') }}" placeholder="Nomor Telepon">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-map-marker-alt text-secondary"></i></span>
                                <input type="text" class="form-control custom-input border-start-0" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" placeholder="Alamat Lengkap">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-lock text-secondary"></i></span>
                                <input type="password" class="form-control custom-input border-start-0" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fa-solid fa-lock text-secondary"></i></span>
                                <input type="password" class="form-control custom-input border-start-0" name="password_confirmation" placeholder="Konfirmasi Password">
                            </div>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">Register</button>
                        </div>
                        <a href="{{ route('login') }}" class="d-block text-center text-secondary">Sudah punya akun? Login di sini</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dist.js') }}"></script>
</body>
</html>
