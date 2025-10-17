<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'id_order',
        'id_produk',
        'qty',
        'price',
        'subtotal'
    ];

    public function order(){
        return $this->belongsTo(Order::class,'id_order','id');
    }
    public function produk(){
        return $this->belongsTo(Produk::class,'id_produk','id');
    }
}
