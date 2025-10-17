<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans'; // nama tabel di database

    protected $fillable = ['nama_jurusan', 'deskripsi']; // opsional

    public function produk()
    {
        // relasi ke model Produk
        return $this->hasMany(Produk::class, 'id_jurusan');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'id_jurusan');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jurusan');
    }

    public function kelasIndustri()
    {
        return $this->hasMany(KelasIndustri::class, 'id_jurusan');
    }


    public function bahan()
    {
        return $this->hasMany(Bahan::class, 'id_jurusan');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'id_jurusan');
    }
}
