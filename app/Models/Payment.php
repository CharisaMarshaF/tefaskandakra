<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'id_order',
        'metode',
        'amount',
        'bukti_file_id',
        'verified_by',
        'status',
        'verified_at',
    ];

    public $timestamps = true;
}
