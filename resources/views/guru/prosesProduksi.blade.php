<x-layout>
<div class="container">
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('prosesProduksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Pilih Target Project</label>
                        <select class="form-select" name="id_project" required>
                            <option value="">-- Pilih project --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->nama_project }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Siswa</label>
                        <select class="form-select" name="id_siswa" required>
                            <option value="">-- Pilih siswa --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Progress</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Upload File Progress</label>
                        <input type="file" class="form-control" name="file">
                        <small class="text-muted">* Format: gambar, dokumen, dll</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Progress (%)</label>
                        <div class="d-flex align-items-center">
                            <input type="range" class="form-range me-3 mt-2 flex-grow-1" min="0"
                                max="100" step="1" value="0" id="progressRange"
                                name="progress_percent" oninput="progressValue.innerText = this.value + '%'">
                            <span id="progressValue" class="fw-semibold text-primary">0%</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Catatan Progress</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan catatan progress..." name="deskripsi"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-2"></i> Simpan Progress
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== FILTER ==================== -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Cari nama project..."
                        id="searchProjects">
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="categoryFilter">
                        <option>Semua Kategori</option>
                        <option>Web Development</option>
                        <option>Mobile App</option>
                        <option>Hardware</option>
                        <option>Furniture</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== GRID PROJECT ==================== -->
    <div class="row g-4">
        @forelse ($projects as $project)
            @php
                $latestProgress = $project->progress->first();
                $progressPercent = $latestProgress->progress_percent ?? 0;
            @endphp

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 project-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-primary mb-0">{{ $project->nama_project }}</h5>

                        @php
                            $badgeClass = match ($project->status) {
                                'draft' => 'bg-secondary text-white',
                                'pending' => 'bg-warning text-dark',
                                'proses' => 'bg-info text-dark',
                                'selesai' => 'bg-success text-white',
                                'dibatalkan' => 'bg-danger text-white',
                                default => 'bg-light text-dark',
                            };
                        @endphp

                        <span class="badge {{ $badgeClass }} text-capitalize">{{ $project->status }}</span>
                    </div>

                    <p class="text-secondary small mb-1">
                        <strong>Dibuat:</strong> {{ $project->created_at->format('Y-m-d') }} <br>
                        <strong>Deadline:</strong> {{ $project->deadline ?? '-' }} <br>
                        <strong>Tim Project:</strong>
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

                    <div class="mt-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Progress</span>
                            <span class="fw-semibold text-dark">{{ $progressPercent }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-2 text-start small text-muted">
                            <i class="bi bi-file-earmark-text"></i>
                            {{ $project->progress_count }}x laporan progress
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                    Tidak ada data project.
                </div>
            @endforelse
        </div>
    </div>

    @push('styles')
        <style>
            .project-card {
                transition: all 0.3s ease;
                border-radius: 12px;
            }

            .project-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchProjects');
                const statusFilter = document.getElementById('categoryFilter');
                const projectCards = document.querySelectorAll('.project-card');

                // Ubah select filter jadi berdasarkan STATUS PROJECT
                statusFilter.innerHTML = `
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="pending">Pending</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                `;

                // Fungsi utama filter
                function filterProjects() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const selectedStatus = statusFilter.value.toLowerCase();

                    projectCards.forEach(card => {
                        const name = card.querySelector('h5').textContent.toLowerCase();
                        const statusBadge = card.querySelector('.badge').textContent.toLowerCase();

                        const matchesName = name.includes(searchTerm);
                        const matchesStatus = selectedStatus === '' || statusBadge === selectedStatus;

                        if (matchesName && matchesStatus) {
                            card.parentElement.style.display = ''; // tampil
                        } else {
                            card.parentElement.style.display = 'none'; // sembunyi
                        }
                    });
                }

                // Event listener live filter
                searchInput.addEventListener('input', filterProjects);
                statusFilter.addEventListener('change', filterProjects);
            });
        </script>
    @endpush

</x-layout>
