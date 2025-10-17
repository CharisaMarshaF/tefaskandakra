<x-layout>
    <section class="content-card p-4 p-md-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="fs-3 fw-bold text-gray-800 mb-4">Nilai & Feedback</h1>
        <div class="bg-light p-4 rounded-4">
            <h2 class="fs-4 fw-bold text-gray-800 mb-4 text-center">Beri Nilai</h2>

            <form action="{{ route('teacher.grades.store') }}" method="POST">
                @csrf
                <div class="row g-4 mb-3">
                    <div class="col-md-12">
                        <label for="judul_tugas" class="form-label fw-semibold">Judul Tugas</label>
                        <input type="text" name="judul_tugas" id="judul_tugas" class="form-control "
                            placeholder="Masukkan judul tugas">
                    </div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="project_select" class="form-label fw-semibold">Pilih Project</label>
                                <select name="id_project" id="project_select" class="form-select form-control " required>
                                    <option value="">Pilih Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->nama_project }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="student_select" class="form-label fw-semibold">Pilih Siswa</label>
                                <select name="id_siswa" id="student_select" class="form-select form-control " required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <div class="col-12 mb-3">
                            <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai" class="form-control custom-input" readonly>
                        </div>
                        <div class="col-12">
                            <label for="deadline" class="form-label fw-semibold">Deadline</label>
                            <input type="date" id="deadline" class="form-control custom-input" readonly>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="feedback" class="form-label fw-semibold">Berikan Feedback...</label>
                        <textarea name="feedback" id="feedback" rows="6" class="form-control "></textarea>
                    </div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="kreativitas" class="form-label fw-semibold">Kreativitas:</label>
                        <input type="number" step="0.01" name="kreativitas" id="kreativitas"
                            class="form-control" placeholder="Masukkan nilai">
                    </div>
                    <div class="col-md-4">
                        <label for="kerjasama_tim" class="form-label fw-semibold">Kerjasama Tim:</label>
                        <input type="number" step="0.01" name="kerjasama_tim" id="kerjasama_tim"
                            class="form-control" placeholder="Masukkan nilai">
                    </div>
                    <div class="col-md-4">
                        <label for="ketepatan_waktu" class="form-label fw-semibold">Ketepatan Waktu:</label>
                        <input type="number" step="0.01" name="ketepatan_waktu" id="ketepatan_waktu"
                            class="form-control" placeholder="Masukkan nilai">
                    </div>
                </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary custom-btn text-white fw-bold">
                        KIRIM NILAI
                    </button>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            const projects = @json($projects);

            const projectSelect = document.getElementById('project_select');
            const startDateInput = document.getElementById('tanggal_mulai');
            const deadlineInput = document.getElementById('deadline');

            projectSelect.addEventListener('change', function() {
                const selectedId = this.value;
                if (!selectedId) {
                    startDateInput.value = '';
                    deadlineInput.value = '';
                    return;
                }

                const selectedProject = projects.find(p => p.id == selectedId);
                if (selectedProject) {
                    startDateInput.value = selectedProject.start_date;
                    deadlineInput.value = selectedProject.deadline;
                }
            });
        </script>
    @endpush
</x-layout>