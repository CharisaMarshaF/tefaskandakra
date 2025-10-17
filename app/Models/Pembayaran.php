<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'id_order',
        'metode',
        'bukti_file_id',
        'verified_by',
        'status',
        'verified_at'
    ];

    public function order(){
        return $this->belongsTo(Order::class,'id_order','id');
    }
}
