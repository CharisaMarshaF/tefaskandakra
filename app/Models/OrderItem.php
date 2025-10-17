<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['id_order', 'id_produk', 'qty', 'price', 'subtotal'];
    public function produk()
{
    return $this->belongsTo(Produk::class, 'id_produk'); // id_produk sesuai kolom di order_items
}

}

