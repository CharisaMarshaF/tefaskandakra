<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingLog extends Model
{
    use HasFactory;

    protected $table = 'tracking_logs';

    protected $fillable = [
        'id_ticket',
        'id_req',
        'status',
        'keterangan',
        'changed_by',
        'changed_at',
    ];

    public function ticket()
    {
        return $this->belongsTo(CSTicket::class, 'id_ticket');
    }

    public function request()
    {
        return $this->belongsTo(CooperationRequest::class, 'id_req');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
