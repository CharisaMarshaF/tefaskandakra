@extends('layouts.admin')

@section('title', 'Laporan Sistem')

{{-- Style block tidak lagi diperlukan dengan Tailwind CSS --}}

@section('content')
<div class="space-y-8">

    {{-- Page Header --}}
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Laporan Sistem</h2>
        <p class="text-slate-500">Monitor aktivasi dan performa sistem sekolah.</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-5 bg-white border rounded-xl shadow-md border-slate-200">
            <p class="mb-1 font-medium text-slate-500">Total Login Hari Ini</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $totalLoginHariIni }}</h3>
        </div>
        <div class="p-5 bg-white border rounded-xl shadow-md border-slate-200">
            <p class="mb-1 font-medium text-slate-500">User Aktif</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $userAktif }}</h3>
        </div>
        <div class="p-5 bg-white border rounded-xl shadow-md border-slate-200">
            <p class="mb-1 font-medium text-slate-500">Total Transaksi</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $totalTransaksi }}</h3>
        </div>
        <div class="p-5 bg-white border rounded-xl shadow-md border-slate-200">
            <p class="mb-1 font-medium text-slate-500">Uptime Sistem</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $uptimeSistem }}</h3>
        </div>
    </div>

    {{-- Tab Container with Alpine.js for state management --}}
    <div x-data="{ tab: 'analitik' }">
        {{-- Tab Buttons --}}
        <div class="flex border-b border-slate-200">
            <button @click="tab = 'analitik'"
                    :class="tab === 'analitik' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                    class="px-4 py-2 text-sm font-medium border-b-2">
                Analitik
            </button>
            <button @click="tab = 'log'"
                    :class="tab === 'log' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                    class="px-4 py-2 text-sm font-medium border-b-2">
                Log Aktivitas
            </button>
        </div>

        {{-- Tab Content --}}
        <div class="py-6">
            {{-- TAB ANALITIK --}}
            <div x-show="tab === 'analitik'" class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <div class="p-6 bg-white border rounded-xl shadow-md lg:col-span-7 border-slate-200">
                    <h5 class="font-bold text-slate-800">Login Harian (7 Hari Terakhir)</h5>
                    <div class="mt-4 h-64">
                        <canvas id="loginChart"></canvas>
                    </div>
                </div>
                <div class="p-6 bg-white border rounded-xl shadow-md lg:col-span-5 border-slate-200">
                     <h5 class="font-bold text-slate-800">Aktivitas User by Role</h5>
                    <div class="mt-4 h-64">
                        <canvas id="roleChart"></canvas>
                    </div>
                </div>
                <div class="p-6 bg-white border rounded-xl shadow-md lg:col-span-12 border-slate-200">
                    <h5 class="font-bold text-slate-800">Ringkasan Penggunaan Sistem</h5>
                    <p class="text-sm text-slate-500">Statistika lengkap penggunaan sistem dalam periode ini</p>
                    <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($ringkasanSistem as $label => $value)
                            <div>
                                <span class="text-slate-500">{{ ucwords(str_replace('_', ' ', $label)) }}</span>
                                <h4 class="text-2xl font-bold text-slate-800">{{ $value }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TAB LOG AKTIVITAS --}}
            <div x-show="tab === 'log'" class="p-6 bg-white border rounded-xl shadow-md border-slate-200">
                <h5 class="font-bold text-slate-800">Log Aktivitas User</h5>
                <p class="text-sm text-slate-500">Riwayat aktivitas terbaru dari semua pengguna sistem</p>
                <div class="mt-4 space-y-3">
                    @forelse($logAktivitas as $log)
                        <div class="flex items-center p-3 border rounded-lg bg-slate-50 border-slate-200 {{ str_contains(strtolower($log->keterangan), 'gagal') ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-emerald-500' }}">
                            <i class="text-2xl text-slate-400 fas fa-user-circle"></i>
                            <div class="ml-3">
                                <p class="font-bold text-slate-700">{{ $log->changedByUser->username ?? 'Sistem' }}</p>
                                <p class="text-sm text-slate-600">{{ $log->keterangan }}</p>
                                <small class="text-slate-400">{{ $log->created_at->format('d-m-Y H:i') }} &middot; {{ $log->ip_address ?? '127.0.0.1' }}</small>
                            </div>
                            <span class="px-2 py-1 ml-auto text-xs font-semibold rounded-full {{ str_contains(strtolower($log->keterangan), 'gagal') ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ str_contains(strtolower($log->keterangan), 'gagal') ? 'Gagal' : 'Berhasil' }}
                            </span>
                        </div>
                    @empty
                        <p class="py-12 text-center text-slate-500">Tidak ada log aktivitas.</p>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $logAktivitas->links() }} {{-- Pastikan Anda sudah mempublish view pagination untuk Tailwind --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Tambahkan Alpine.js untuk fungsionalitas tab. Letakkan sebelum script Anda yang lain. --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- Script Chart.js Anda tidak perlu diubah sama sekali --}}
<script>
    // Data dari Controller
    const loginLabels = @json($chartLabels);
    const loginData = @json($chartData);
    const roleLabels = @json($aktivitasByRole->keys());
    const roleData = @json($aktivitasByRole->values());

    // Chart Login Harian
    new Chart(document.getElementById('loginChart'), {
        type: 'line',
        data: {
            labels: loginLabels,
            datasets: [{
                label: 'Jumlah Login',
                data: loginData,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    // Chart Aktivitas by Role
    new Chart(document.getElementById('roleChart'), {
        type: 'doughnut',
        data: {
            labels: roleLabels,
            datasets: [{
                label: 'Aktivitas',
                data: roleData,
                backgroundColor: ['#3b82f6', '#10b981', '#f97316', '#ef4444', '#8b5cf6'],
                hoverOffset: 4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
    });
</script>
@endpush
