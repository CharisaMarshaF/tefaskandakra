<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokTransaksi extends Model
{
    protected $table = 'stok_transaksis';
    protected $fillable = [
        'id_bahan',
        'jenis',
        'qty',
        'tanggal',
        'reference',
        'keterangan'
    ];

    public function bahan(){
        return $this->belongsTo(Bahan::class,'id_bahan','id');
    }
}
