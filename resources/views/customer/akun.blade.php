@extends('layouts.costumer.app')

@section('title', 'Akun')

@section('content')

 <!-- Breadcrumb -->
 <div data-aos="fade-up" class="container-fluid px-4 px-md-5 pt-4">
    <div class="max-container">
        <ol class="breadcrumb mb-0 p-3 bg-white rounded shadow-lg">
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Halaman</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Profil</li>
        </ol>
    </div>
</div>

<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="form-card">
            <div class="row g-4 align-items-start">
                <!-- Sidebar -->
                <div class="col-md-4 col-lg-3">
                    <div class="sidebar-section">
                        <img src="{{ asset('img/profil.png') }}" alt="Profile Image" />
                        <h5>{{ $user->username }}</h5>
                        <small>{{ $user->email }}</small>
                        {{-- <button class="nav-btn active">Info Akun <i class="fa fa-arrow-right"></i></button>
                        <button class="nav-btn">Order <i class="fa fa-arrow-right"></i></button>
                        <button class="nav-btn">Alamat <i class="fa fa-arrow-right"></i></button> --}}
                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-8 col-lg-9"><br>
                    <h5 class="fw-bold mb-4">Akun Info</h5><br>
                    <form id="akunForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label required mb-3">First Name <span style="color:red">*</span></label>
                                <input type="text" name="first_name" class="form-control" 
                                    value="{{ explode(' ', $user->username)[0] ?? '' }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required mb-3">Last Name <span style="color:red">*</span></label>
                                <input type="text" name="last_name" class="form-control" 
                                    value="{{ explode(' ', $user->username)[1] ?? '' }}" required />
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label required mb-3">Email Address <span style="color:red">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required />
                        </div>
                    
                        <div class="mb-4">
                            <label class="form-label required mb-3">Phone Number <small class="text-muted">(Optional)</small></label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" />
                        </div><br><br>
                    
                        <button type="submit" class="btn btn-submit">SAVE</button>
                    </form>

                    <!-- Tempat alert -->
                    <div id="alertBox" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('akunForm').addEventListener('submit', function(e) {
        e.preventDefault();
    
        let formData = new FormData(this);
    
        fetch("{{ route('customer.akun.update') }}", {
            method: "POST", // tetap POST
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "X-HTTP-Method-Override": "PUT"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            let alertBox = document.getElementById('alertBox');
            if(data.success){
                alertBox.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

                // update sidebar
                document.querySelector('.sidebar-section h5').innerText = data.user.username;
                document.querySelector('.sidebar-section small').innerText = data.user.email;

                // Hilangkan notifikasi dalam 5 detik + refresh halaman
                setTimeout(() => {
                    alertBox.innerHTML = "";
                    window.location.reload();
                }, 5000);

            } else {
                alertBox.innerHTML = `<div class="alert alert-danger">Gagal update!</div>`;
                setTimeout(() => {
                    alertBox.innerHTML = "";
                }, 1000);
            }
        })
        .catch(err => console.error(err));
    });
</script>

@endpush
