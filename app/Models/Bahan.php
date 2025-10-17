<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahans';

    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'jenis',
        'satuan',
        'stok',
        'minimal_stok',
        'harga_satuan',
        'id_jurusan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function stokTransaksi()
    {
        return $this->hasMany(StokTransaksi::class, 'id_bahan');
    }
}
