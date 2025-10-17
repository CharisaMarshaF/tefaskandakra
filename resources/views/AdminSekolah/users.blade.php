@extends('layouts.admin')

@section('title', 'Manajemen User & Hak Akses')

@section('content')
    <div class="flex flex-col gap-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Manajemen User & Hak Akses</h2>
                <p class="text-slate-500">Kelola pengguna sistem dan atur hak akses.</p>
            </div>
            <button
                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                data-modal-target="userModal" data-modal-toggle="userModal">
                <i class="fa-solid fa-plus"></i> Tambah User
            </button>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="bg-white border border-slate-200 shadow-sm rounded-xl p-5 flex justify-between items-center hover:-translate-y-1 hover:shadow-md transition">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Total User</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $totalUser }}</h3>
                </div>
                <i class="fa-solid fa-users text-indigo-500/40 text-3xl"></i>
            </div>
            <div
                class="bg-white border border-slate-200 shadow-sm rounded-xl p-5 flex justify-between items-center hover:-translate-y-1 hover:shadow-md transition">
                <div>
                    <p class="text-slate-500 text-sm font-medium">User Aktif</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $userAktif }}</h3>
                </div>
                <i class="fa-solid fa-user-check text-green-500/40 text-3xl"></i>
            </div>
            <div
                class="bg-white border border-slate-200 shadow-sm rounded-xl p-5 flex justify-between items-center hover:-translate-y-1 hover:shadow-md transition">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Guru</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $totalGuru }}</h3>
                </div>
                <i class="fa-solid fa-chalkboard-teacher text-sky-500/40 text-3xl"></i>
            </div>
            <div
                class="bg-white border border-slate-200 shadow-sm rounded-xl p-5 flex justify-between items-center hover:-translate-y-1 hover:shadow-md transition">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Admin</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $totalAdmin }}</h3>
                </div>
                <i class="fa-solid fa-shield-halved text-red-500/40 text-3xl"></i>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <form action="{{ route('user.admin_sekolah') }}" method="GET"
                class="flex flex-col sm:flex-row justify-between gap-3 mb-6">
                <h5 class="font-semibold text-slate-800">Daftar User</h5>
                <div class="flex flex-wrap gap-2">
                    <input type="text" name="search" placeholder="Cari user..." value="{{ request('search') }}"
                        class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <select name="role"
                        class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                        <option value="">Semua Role</option>
                        @foreach ($rolesforFilter as $role)
                            <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-t border-slate-200">
                    <thead class="bg-slate-50 text-slate-600 font-semibold">
                        <tr>
                            <th class="py-3 px-4">Nama</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Role</th>
                            <th class="py-3 px-4">Jurusan</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Login Terakhir</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3 px-4 font-semibold text-slate-800">{{ $user->username }}</td>
                                <td class="py-3 px-4 text-slate-600">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    @php
                                        $roleName = $user->role->name;
                                        $roleColors = [
                                            'Siswa' => 'bg-green-100 text-green-700',
                                            'Guru' => 'bg-sky-100 text-sky-700',
                                            'Kepala Sekolah' => 'bg-indigo-100 text-indigo-700',
                                            'DUDI' => 'bg-yellow-100 text-yellow-700',
                                            'Orang Tua' => 'bg-slate-100 text-slate-700',
                                            'Admin TEFA' => 'bg-red-100 text-red-700',
                                            'Admin Sekolah' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $roleColors[$roleName] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $roleName }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $user->siswa?->jurusan?->nama_jurusan ?? ($user->guru?->jurusan?->nama_jurusan ?? '-') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $user->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-500">
                                    @if ($user->last_activity)
                                        {{ \Carbon\Carbon::createFromTimestamp($user->last_activity)->locale('id')->diffForHumans() }}
                                    @else
                                        Belum pernah login
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('user.admin_sekolah.destroy', $user->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="text-red-600 hover:text-red-800 mx-1 btn-delete">
                                        <i class="fa-solid fa-trash"></i>
                                      </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-slate-500">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div id="userModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg mx-4 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-slate-200">
                <h3 class="text-lg font-semibold text-slate-800">Tambah User Baru</h3>
                <button type="button" class="text-slate-500 hover:text-slate-700" data-modal-hide="userModal">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form action="{{ route('user.admin_sekolah.store') }}" method="POST" class="px-6 py-5 space-y-4">
                @csrf

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('username')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        minlength="8" required>
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="id_role" class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="id_role" id="id_role"
                        class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('id_role') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_role')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-200">
                    <button type="button" data-modal-hide="userModal"
                        class="px-4 py-2 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.getElementById(btn.dataset.modalTarget);
                target.classList.remove('hidden');
            });
        });

        document.querySelectorAll('[data-modal-hide]').forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.fixed');
                modal.classList.add('hidden');
            });
        });
    </script>
@endpush
