<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPosisi extends Model
{
    use HasFactory;

    protected $table = 'lowongan_posisis';

    protected $fillable = [
        'id_lowongan',
        'posisi',
        'jumlah_dibutuhkan',
        'deskripsi',
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }

    public function pengajuanKelasIndustri()
    {
        return $this->hasMany(PengajuanKelasIndustri::class, 'id_posisi');
    }
}
