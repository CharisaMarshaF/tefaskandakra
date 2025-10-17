<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'id_perusahaan',
        'judul_lowongan',
        'deskripsi',
        'gambar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    public function posisi()
    {
        return $this->hasMany(LowonganPosisi::class, 'id_lowongan');
    }

    public function pengajuanKelasIndustri()
    {
        return $this->hasMany(PengajuanKelasIndustri::class, 'id_lowongan');
    }
}
