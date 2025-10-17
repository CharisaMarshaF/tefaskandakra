<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_no',
        'id_user',
        'total',
        'shipping_address',
        'status',
    ];

    public function items()
    {
        // relasi dari orders → order_items (id_order)
        return $this->hasMany(OrderItem::class, 'id_order');
    }

    public function user()
    {
        // relasi dari orders → users (id_user)
        return $this->belongsTo(User::class, 'id_user');
    }
}
