<!DOCTYPE html>
<html>

<head>
    <title>Detail Projek</title>
    <style>
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .tuntas {
            background: green;
        }

        .belum {
            background: red;
        }
    </style>
</head>

<body>
    <h2>Detail Projek</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Kelas</th>
            <td>{{ $project->kelasindustri?->nama_kelas ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai</th>
            <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Guru Pendamping</th>
            <td>{{ $project->guru?->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Mitra</th>
            <td>{{ $project->perusahaan?->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Projek</th>
            <td>{{ $project->nama_project }}</td>
        </tr>
        <tr>
            <th>Tim</th>
            <td>
                @if($project->projectmember && $project->projectmember->count())
                    <ul>
                        @foreach($project->projectmember as $member)
                            <li>{{ $member->siswa?->nama_lengkap ?? '-' }}</li>
                        @endforeach
                    </ul>
                @else
                    <span>-</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Deadline</th>
            <td>{{ \Carbon\Carbon::parse($project->deadline)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Dokumen</th>
            <td>
                @if(!empty($project->dokumen))
                    <a href="{{ asset('storage/' . $project->dokumen) }}" target="_blank">Lihat Dokumen</a>
                @else
                    <span>-</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($project->status === 'selesai')
                    <span class="status tuntas">Tuntas</span>
                @else
                    <span class="status belum">Belum Tuntas</span>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
