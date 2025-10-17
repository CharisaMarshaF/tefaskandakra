@extends('layouts.costumer.app')

@section('title', 'Layanan Pelanggan')

@section('content')

<!-- Modal Ticket Success -->
<div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <h5 class="mb-4 fw-bold" id="ticketModalLabel">Permintaan Anda telah dikirim</h5>
                <img src="{{ asset('img/bera.png') }}" alt="Success Illustration" class="img-fluid mb-4" style="max-width: 200px;">
                <p class="mb-1"><strong>Nomor Ticket Anda:</strong> 
                    <a href="#" id="modalTicketNumber" class="text-primary text-decoration-none"></a>
                </p>
                <p class="text-muted mb-0">Simpan nomor ini untuk cek status pengajuan Anda.</p>
                <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(session('ticket_number'))
        document.getElementById('modalTicketNumber').innerText = "{{ session('ticket_number') }}";
        var ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
        ticketModal.show();
    @endif
});
</script>


<h1 data-aos="fade-up" class="text-center mt-5">Layanan Pelanggan</h1>
<p data-aos="fade-up" class="text-center">Ajukan pertanyaan atau laporkan kendala melalui form di bawah.</p>

<!-- FORM LAYANAN PELANGGAN -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5">
    <div class="max-container">
        <div class="form-card">
            <div class="d-flex justify-content-center">
                <div class="card-body">
                    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Nama <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                            </div>

                            <!-- Kategori Masalah -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Kategori Masalah <span style="color:red">*</span></label>
                                <select class="form-select" name="kategori" required>
                                    <option selected disabled>Pilih Kategori</option>
                                    <option value="teknis">Teknis</option>
                                    <option value="pembayaran">Pembayaran</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- Email / HP -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Email / Nomer Hp <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="kontak" value="{{ old('kontak') }}" required>
                            </div>

                            <!-- Subject -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Subject <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                            </div>

                            <!-- Lampiran -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Lampiran (optional)</label>
                                <input type="file" class="form-control" name="lampiran"
                                    accept=".jpg,.jpeg,.png,.pdf,.mp4">
                            </div>

                            <!-- Pesan -->
                            <div class="col-md-6">
                                <label class="form-label my-2">Pesan <span style="color:red">*</span></label>
                                <textarea class="form-control mb-3" rows="8" name="message" required>{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-5">
                            <button type="submit" class="btn-submit">KIRIM PENGAJUAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TRACKING STATUS -->
<div data-aos="fade-up" class="container-fluid px-4 px-md-5 py-5 mb-5">
    <div class="max-container">
        <div class="form-card">
            <h5 class="mb-3 fw-bold">TRACKING STATUS</h5>

            <!-- Form pencarian tiket -->
            <form action="{{ route('customer.tracking') }}" method="get" class="mb-4">
                <input type="text" name="kode_tiket" class="form-control mb-3 mb-4"
                    placeholder="Masukkan ID pengajuan atau subject untuk cek status"
                    value="{{ request('kode_tiket') }}">
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tracking ID</th>
                            <th>Subject</th>
                            <th>Pesan</th>
                            <th>Lampiran</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td><strong>{{ $ticket->kode_tiket }}</strong></td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ Str::limit($ticket->message, 30) }}</td>
                                <td>
                                    @if ($ticket->file)
                                        <a href="{{ asset('storage/tickets/' . $ticket->file->nama_file) }}" target="_blank">
                                            {{ $ticket->file->nama_file }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $ticket->catatan_admin ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge 
                                        @if ($ticket->status == 'open') bg-warning-subtle text-warning
                                        @elseif($ticket->status == 'in_progress') bg-primary-subtle text-primary
                                        @else bg-success-subtle text-success @endif
                                        px-3 py-2 rounded-pill">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Detail Modal -->
                                    <button class="btn btn-link p-0 me-2 text-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ticketDetailModal"
                                        data-ticket='@json($ticket)'>
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Hapus -->
                                    <form action="{{ route('customer.ticket.destroy', $ticket->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tiket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Modal Detail Tiket -->
<div class="modal fade" id="ticketDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tracking ID:</strong> <span id="modal_kode"></span></p>
                <p><strong>Subject:</strong> <span id="modal_subject"></span></p>
                <p><strong>Pesan:</strong> <span id="modal_message"></span></p>
                <p><strong>Status:</strong> <span id="modal_status"></span></p>
                <p><strong>Catatan Admin:</strong> <span id="modal_catatan"></span></p>
                <p><strong>Lampiran:</strong> <span id="modal_file"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ticketDetailModal = document.getElementById('ticketDetailModal');
    ticketDetailModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var ticket = JSON.parse(button.getAttribute('data-ticket'));

        document.getElementById('modal_kode').innerText = ticket.kode_tiket;
        document.getElementById('modal_subject').innerText = ticket.subject;
        document.getElementById('modal_message').innerText = ticket.message;
        document.getElementById('modal_status').innerText = ticket.status;
        document.getElementById('modal_catatan').innerText = ticket.catatan_admin ?? '-';

        if(ticket.file){
            document.getElementById('modal_file').innerHTML =
                `<a href="/storage/tickets/${ticket.file.nama_file}" target="_blank">${ticket.file.nama_file}</a>`;
        } else {
            document.getElementById('modal_file').innerText = '-';
        }
    });
});
</script>

@endsection
