<x-layout>
    <section id="detail-project" class="p-6 md:p-10 content-card rounded-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                Detail Project: {{ $project->nama_project }}
            </h1>
            {{-- <a href="{{ route('teacher.projects.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm">
                ← Kembali
            </a> --}}
        </div>

        {{-- Informasi Utama --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Informasi Umum</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <p><span class="font-medium text-gray-800">Kode Project:</span> {{ $project->kode_project }}</p>
                <p><span class="font-medium text-gray-800">Guru:</span> {{ $project->guru?->nama ?? '-' }}</p>
                <p><span class="font-medium text-gray-800">Perusahaan:</span> {{ $project->perusahaan?->nama ?? '-' }}</p>
                <p><span class="font-medium text-gray-800">Jurusan:</span> {{ $project->jurusan?->nama_jurusan ?? '-' }}</p>
                <p><span class="font-medium text-gray-800">Kelas Industri:</span> {{ $project->kelasindustri?->nama_kelas ?? '-' }}</p>
                <p><span class="font-medium text-gray-800">Tanggal Mulai:</span> {{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d F Y') }}</p>
                <p><span class="font-medium text-gray-800">Deadline:</span> {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('d F Y') }}</p>
                <p><span class="font-medium text-gray-800">Status:</span>
                    <span class="px-2 py-1 rounded-lg text-white 
                        {{ $project->status === 'selesai' ? 'bg-green-500' :
                           ($project->status === 'proses' ? 'bg-blue-500' :
                           ($project->status === 'pending' ? 'bg-yellow-500' : 'bg-gray-400')) }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Progress Terbaru --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Progress Terbaru</h2>
            <div class="mb-2 flex items-center justify-between">
                <span class="text-gray-600 text-sm">Total Progress</span>
                <span class="text-gray-800 font-semibold text-sm">{{ $progressPercent }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-500 h-2.5 rounded-full transition-all duration-500"
                     style="width: {{ $progressPercent }}%">
                </div>
            </div>
        </div>

        {{-- Daftar Anggota --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Tim Project</h2>
            @if($project->members->count() > 0)
                <ul class="list-disc list-inside text-sm text-gray-700">
                    @foreach($project->members as $member)
                        <li>
                            {{ $member->siswa?->nama_lengkap ?? '-' }}
                            <span class="text-gray-500">({{ $member->role }})</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 italic text-sm">Belum ada anggota dalam project ini.</p>
            @endif
        </div>

        {{-- Riwayat Progress --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Riwayat Progress</h2>
            @if($project->progress->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 border">
                        <thead class="bg-gray-100 text-gray-600 font-semibold">
                            <tr>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Progress (%)</th>
                                <th class="px-4 py-2 border">Deskripsi</th>
                                <th class="px-4 py-2 border">Dikirim Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project->progress as $progress)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($progress->tanggal)->translatedFormat('d F Y H:i') }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $progress->progress_percent }}%</td>
                                    <td class="px-4 py-2 border">{{ $progress->deskripsi ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $progress->submittedBy?->username ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400 italic text-sm">Belum ada progress yang dilaporkan.</p>
            @endif
        </div>
    </section>
</x-layout>