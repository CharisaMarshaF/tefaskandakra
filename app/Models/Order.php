<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_no',
        'id_user',
        'total',
        'shipping_address',
        'status'
    ];

    public function order(){
        return $this->hasMany(Pemesanan::class,'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'id_order'); // Use 'id_order' as the foreign key
    }

    public function items(){
        return $this->belongsTo(Pemesanan::class,'id');
    }


}
