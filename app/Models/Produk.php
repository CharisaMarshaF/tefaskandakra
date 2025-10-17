<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk', 'nama_produk', 'id_jurusan', 'deskripsi',
        'kategori', 'harga', 'satuan', 'stok', 'status', 'id_foto'
    ];

    

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_produk');
    }
    
    public function foto() {
        return $this->belongsTo(Foto::class, 'id_foto');
    }
}
