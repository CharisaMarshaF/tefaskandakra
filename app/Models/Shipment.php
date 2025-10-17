<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $fillable = [
        'id_order',
        'courier',
        'tracking_no',
        'status',
        'packed_by',
        'shipped_at',
        'delivered_at',
    ];

    public function order(){
        return $this->belongsTo(Order::class,'id_order');
    }
    public function user(){
        return $this->belongsTo(User::class,'packed_by','id');
    }
}
