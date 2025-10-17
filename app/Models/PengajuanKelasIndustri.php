<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanKelasIndustri extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_kelas_industri';

    protected $fillable = [
        'id_siswa',
        'id_lowongan',
        'id_posisi',
        'id_kelas',
        'id_jurusan',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }

    public function posisi()
    {
        return $this->belongsTo(LowonganPosisi::class, 'id_posisi');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
