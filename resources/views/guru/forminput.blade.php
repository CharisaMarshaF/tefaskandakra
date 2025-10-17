<x-layout>
    <!-- Form Container -->
    <div class="form-container">
        <!-- Left Form - Buat Project Baru -->
        <div class="form-card">
            <h3 class="form-title">Buat Project Baru</h3>
            <form action="{{ route('teacher.projects.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Project</label>
                    <input type="text" class="form-control" name="nama_project" placeholder="Masukkan judul project"
                        required>
                </div>

                <!-- Guru -->
                <div class="form-group">
                    <label class="form-label">Pilih Guru</label>
                    <select class="form-select" name="id_guru" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }} ({{ $guru->user->username ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jurusan -->
                <div class="form-group">
                    <label class="form-label">Pilih Jurusan</label>
                    <select class="form-select" name="id_jurusan" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kelas Industri -->
                <div class="form-group">
                    <label class="form-label">Kelas Industri</label>
                    <select class="form-select" name="id_kelasindustri" required>
                        <option value="">-- Pilih Kelas Industri --</option>
                        @foreach ($kelasIndustri as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }} ({{ $kelas->angkatan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Perusahaan -->
                <div class="form-group">
                    <label class="form-label">Perusahaan</label>
                    <select class="form-select" name="id_perusahaan" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama }} -
                                {{ $perusahaan->user->email ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Mulai - Deadline</label>
                    <div class="date-group">
                        <div class="date-input">
                            <input type="date" name="start_date" required>
                            <i class="bi bi-calendar-event date-icon"></i>
                        </div>
                        <div class="date-input">
                            <input type="date" name="deadline" required>
                            <i class="bi bi-calendar-event date-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Project</label>
                    <textarea class="form-textarea" name="deskripsi" placeholder="Tuliskan tentang detail project..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Output yang Diharapkan</label>
                    <textarea class="form-textarea" name="expected_output" placeholder="Tuliskan hasil akhir yang diharapkan..."></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    ➤ KIRIM PROJECT
                </button>
            </form>
        </div>

        <!-- Right Form - Ubah Deadline -->
        <div class="form-card">
            <h3 class="form-title">Ubah Deadline</h3>
            <form action="{{ route('teacher.projects.updateDeadline') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Pilih Project</label>
                    <select class="form-select" id="selectProject" name="id_project" required>
                        <option value="">-- Pilih Project --</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">
                                {{ $project->kode_project }} - {{ $project->nama_project }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Mulai</label>
                    <div class="date-input">
                        <input type="date" id="startDate" readonly>
                        <i class="bi bi-calendar-event date-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deadline Saat Ini</label>
                    <div class="date-input">
                        <input type="date" id="deadlineDate" readonly>
                        <i class="bi bi-calendar-event date-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deadline Baru</label>
                    <div class="date-input">
                        <input type="date" name="new_deadline" id="newDeadline" required>
                        <i class="bi bi-calendar-event date-icon"></i>
                    </div>
                </div>

                <button type="submit" class="btn-deadline">
                    UBAH DEADLINE
                </button>
            </form>
        </div>
    </div>

    @push('styles')
        <style>
            .user-section {
                display: flex;
                align-items: center;
            }

            .notification-icon {
                margin-right: 20px;
                color: #6c757d;
                font-size: 18px;
            }

            .user-profile {
                display: flex;
                align-items: center;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                background-color: #6c757d;
                border-radius: 50%;
                margin-right: 10px;
            }

            .user-info h6 {
                margin: 0;
                font-size: 14px;
                font-weight: 600;
            }

            .user-info small {
                color: #6c757d;
                font-size: 12px;
            }

            .content-wrapper {
                padding: 30px;
                background-color: #f5f5f5;
            }

            .page-header {
                margin-bottom: 30px;
            }

            .page-title h2 {
                font-size: 28px;
                font-weight: 600;
                margin: 0 0 10px 0;
                color: #1a202c;
            }

            .add-project-btn {
                background: linear-gradient(135deg, #6366f1, #4338ca);
                border: none;
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                margin-bottom: 30px;
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .add-project-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
            }

            .form-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
                max-width: 1200px;
            }

            .form-card {
                background: white;
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                border: 1px solid #f1f5f9;
            }

            .form-title {
                font-size: 20px;
                font-weight: 600;
                color: #1a202c;
                margin-bottom: 25px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-weight: 500;
                color: #374151;
                margin-bottom: 8px;
                font-size: 14px;
            }

            .form-control {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }

            .form-select {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
                background: white;
                cursor: pointer;
            }

            .date-group {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .date-input {
                position: relative;
            }

            .date-input input[type="date"] {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
            }

            .date-icon {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
                pointer-events: none;
            }

            .form-textarea {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
                min-height: 120px;
                resize: vertical;
            }

            .btn-submit {
                background: linear-gradient(135deg, #6366f1, #4338ca);
                border: none;
                color: white;
                padding: 12px 30px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s ease;
                width: 100%;
            }

            .btn-submit:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
            }

            .btn-deadline {
                background: linear-gradient(135deg, #f97316, #ea580c);
                border: none;
                color: white;
                padding: 12px 30px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s ease;
                width: 100%;
            }

            .btn-deadline:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
            }

            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                }

                .form-container {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
            }

            @media (max-width: 576px) {
                .content-wrapper {
                    padding: 20px 15px;
                }

                .form-card {
                    padding: 20px;
                }
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add focus effects to form inputs
                const inputs = document.querySelectorAll('.form-control, .form-select, .form-textarea');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.style.borderColor = '#6366f1';
                        this.style.boxShadow = '0 0 0 3px rgba(99, 102, 241, 0.1)';
                    });

                    input.addEventListener('blur', function() {
                        this.style.borderColor = '#e2e8f0';
                        this.style.boxShadow = 'none';
                    });
                });
            });
        </script>
        <script>
            const projects = @json($projects);

            const selectProject = document.getElementById('selectProject');
            const startDate = document.getElementById('startDate');
            const deadlineDate = document.getElementById('deadlineDate');

            selectProject.addEventListener('change', function() {
                const selectedId = this.value;
                const project = projects.find(p => p.id == selectedId);

                if (project) {
                    startDate.value = project.start_date;
                    deadlineDate.value = project.deadline;
                } else {
                    startDate.value = '';
                    deadlineDate.value = '';
                }
            });
        </script>
    @endpush
</x-layout>
