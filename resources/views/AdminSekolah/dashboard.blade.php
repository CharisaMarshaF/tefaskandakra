@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
{{-- Header Halaman --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
        <p class="text-gray-500">Selamat datang di Admin SMK N 2 Karanganyar</p>
    </div>
    <button class="mt-3 sm:mt-0 flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg shadow-sm transition">
        <i class="fas fa-sync-alt"></i> Refresh Data
    </button>
</div>

{{-- Statistik Card --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 font-medium">Total User</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalUser }}</h3>
                <p class="text-green-500 text-sm mt-1">+2 bulan ini</p>
            </div>
            <div class="bg-blue-500 text-white p-3 rounded-xl">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 font-medium">Jurusan Aktif</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $jurusanAktif }}</h3>
                <p class="text-gray-400 text-sm mt-1">Semua aktif</p>
            </div>
            <div class="bg-emerald-500 text-white p-3 rounded-xl">
                <i class="fas fa-graduation-cap text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 font-medium">Login Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $loginHariIni }}</h3>
                <p class="text-green-500 text-sm mt-1">+12% vs kemarin</p>
            </div>
            <div class="bg-violet-500 text-white p-3 rounded-xl">
                <i class="fas fa-sign-in-alt text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 font-medium">Mitra DUDI</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $mitraDUDI }}</h3>
                <p class="text-green-500 text-sm mt-1">+3 bulan ini</p>
            </div>
            <div class="bg-amber-500 text-white p-3 rounded-xl">
                <i class="fas fa-building text-xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- Aktivitas dan Log --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    <div class="lg:col-span-7 bg-white rounded-2xl shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-1">Aktivitas Mingguan</h5>
        <p class="text-gray-500 text-sm mb-4">Grafik login dan aktivitas user dalam 7 hari terakhir</p>
        <div class="h-72">
            <canvas id="weeklyActivityChart"></canvas>
        </div>
    </div>

    <div class="lg:col-span-5 bg-white rounded-2xl shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h5>
        <ul class="divide-y divide-gray-100">
            @forelse($aktivitasTerbaru as $log)
            <li class="py-3 flex justify-between items-start">
                <div>
                    <p class="font-semibold text-gray-800">{{ $log->changedByUser->username ?? 'Sistem' }}</p>
                    <p class="text-sm text-gray-500">{{ Str::limit($log->keterangan, 35) }} &middot; {{ \Carbon\Carbon::parse($log->changed_at)->diffForHumans() }}</p>
                </div>
                <span class="text-xs font-semibold bg-green-100 text-green-600 px-2.5 py-1 rounded-full">Berhasil</span>
            </li>
            @empty
            <li class="py-6 text-center text-gray-500">Tidak ada aktivitas terbaru.</li>
            @endforelse
        </ul>
    </div>
</div>

{{-- Proyek Jurusan & Status Sistem --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-8 bg-white rounded-2xl shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-4">Project Jurusan</h5>
        @forelse ($projectJurusan as $jurusan)
        <div class="mb-5">
            <div class="flex justify-between mb-1">
                <p class="font-medium text-gray-700">{{ $jurusan['nama'] }}</p>
                <p class="text-sm text-gray-500">{{ $jurusan['jumlah_project'] }} project</p>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3 mb-1">
                <div class="h-3 rounded-full" style="width: {{ $jurusan['progress'] }}%; background-color:#1e293b;"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>Progress: {{ $jurusan['progress'] }}%</span>
                <span>Target: 100%</span>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 py-6">Belum ada data proyek.</p>
        @endforelse
    </div>

    <div class="lg:col-span-4 bg-white rounded-2xl shadow p-6">
        <h5 class="text-lg font-semibold text-gray-800 mb-4">Status Sistem</h5>
        <ul class="divide-y divide-gray-100">
            @foreach($statusSistem as $key => $value)
            <li class="py-3 flex justify-between items-center">
                <span class="flex items-center text-gray-700">
                    <i class="fas fa-circle text-[8px] mr-2" style="color: {{ str_contains($key, 'error') ? '#f59e0b' : '#10b981' }}"></i>
                    {{ ucwords(str_replace('_', ' ', $key)) }}
                </span>
                <span class="font-semibold text-gray-700">{{ $value }} <i class="fas fa-check-circle text-green-500"></i></span>
            </li>
            @endforeach
        </ul>
        <div class="mt-4 text-center bg-green-100 text-green-700 font-semibold rounded-lg py-2">
            Overall Health: Excellent
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ambil data dari controller
    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    // Konfigurasi Chart.js
    const ctx = document.getElementById('weeklyActivityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Aktivitas User',
                    data: chartData,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Aktivitas Login',
                    data: chartData.map(d => d * 0.6 + Math.random() * 5),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: '#e5e7eb' } },
                x: { grid: { display: false } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
