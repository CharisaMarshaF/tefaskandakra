<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsTicket extends Model
{
    use HasFactory;

    protected $table = 'cs_tickets';

    protected $fillable = [
        'id_user',
        'kode_tiket',
        'subject',
        'message',
        'status',
        'assigned_to',
        'catatan_admin',
        'id_file'
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'id_file');
    }

    /**
     * Relasi ke User (yang buat tiket)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
