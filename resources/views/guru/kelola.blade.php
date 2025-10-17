<x-layout>
    <section id="kelola-content" class="p-6 md:p-10 content-card rounded-3xl">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Kelola Project Siswa</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
                @php
                    $latestProgress = $project->progress->first();
                    $progressPercent = $latestProgress ? $latestProgress->progress_percent : 0;
                    $deadline = \Carbon\Carbon::parse($project->deadline)->format('d F Y');
                @endphp
                <div class="bg-gray-50 p-6 rounded-2xl shadow-md">
                    <h3 class="font-bold text-lg mb-1">{{ $project->nama_project }}</h3>
                        {{-- <p class="text-sm text-gray-500 mb-3">Klien: {{ $project->perusahaan->nama }}</p> --}}
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">Progress</p>
                        <div class="bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $progressPercent }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1 block">
                            {{ $progressPercent }}%
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">
                        Tim:
                        @if ($project->members->count() > 0)
                            @foreach ($project->members as $index => $member)
                                {{ $member->siswa?->nama_lengkap ?? 'kosong' }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        @else
                            <span class="italic text-gray-400">Belum ada anggota</span>
                        @endif
                    </p>
                    <p class="text-sm text-gray-600 mb-4">Deadline: {{ $deadline }}</p>
                    <div class="flex justify-between space-x-2">
                        <a href="{{ route('teacher.projects.detailProject', $project->kode_project) }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-xl text-sm w-full hover:bg-blue-600">
                            Lihat Detail
                        </a>

                    </div>
                </div>
                @empty
                    <p>Kosong Kang</p>
                @endforelse
            </div>
        </section>

        {{-- <section id="nilai-content" class="p-6 md:p-10 content-card rounded-3xl ">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Nilai & Feedback</h1>
        <div class="bg-gray-50 p-6 rounded-2xl">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-6 text-center">Beri Nilai</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="judul_tugas" class="block font-semibold text-gray-700 mb-2">Judul Tugas</label>
                    <input type="text" id="judul_tugas"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none"
                        value="Aplikasi Kasir Toko Modern" readonly>
                </div>
                <div>
                    <label for="kategori_project" class="block font-semibold text-gray-700 mb-2">Kategori
                        Project</label>
                    <input type="text" id="kategori_project"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" value="Kasir" readonly>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="flex flex-col md:flex-row md:space-x-6">
                    <div class="flex-1 mb-6 md:mb-0">
                        <label for="tanggal_mulai" class="block font-semibold text-gray-700 mb-2">Tanggal
                            Mulai</label>
                        <div class="relative">
                            <input type="text" id="tanggal_mulai"
                                class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" value="8/07/2025"
                                readonly>
                            <i class="fas fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="deadline" class="block font-semibold text-gray-700 mb-2">Deadline</label>
                        <div class="relative">
                            <input type="text" id="deadline"
                                class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" value="08/07/2025"
                                readonly>
                            <i class="fas fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="feedback" class="block font-semibold text-gray-700 mb-2">Berikan
                        Feedback...</label>
                    <textarea id="feedback" rows="4"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="kreativitas" class="block font-semibold text-gray-700 mb-2">Kreativitas:</label>
                    <input type="text" id="kreativitas"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" placeholder="Masukkan nilai">
                </div>
                <div>
                    <label for="kerjasama_tim" class="block font-semibold text-gray-700 mb-2">Kerjasama
                        Tim:</label>
                    <input type="text" id="kerjasama_tim"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" placeholder="Masukkan nilai">
                </div>
                <div>
                    <label for="ketepatan_waktu" class="block font-semibold text-gray-700 mb-2">Ketepatan
                        Waktu:</label>
                    <input type="text" id="ketepatan_waktu"
                        class="w-full px-4 py-3 rounded-xl form-input focus:outline-none" placeholder="Masukkan nilai">
                </div>
            </div>

            <div class="mt-8 text-center">
                <button
                    class="btn-primary px-16 py-3 rounded-xl text-white font-semibold hover:bg-blue-700 transition-colors">
                    KIRIM NILAI
                </button>
            </div>
        </div>
    </section> --}}
    </x-layout>
