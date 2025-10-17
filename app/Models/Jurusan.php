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
}
