<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasIndustri extends Model
{
    use HasFactory;

    protected $table = 'kelas_industris';

    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'angkatan',
        'kapasitas',
        'id_jurusan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelasindustri');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'id_kelasindustri');
    }

    public function jadwalProduksi()
    {
        return $this->hasMany(JadwalProduksi::class, 'id_kelasindustri');
    }
}
