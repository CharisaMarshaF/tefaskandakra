<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nis',
        'nisn',
        'nama_lengkap',
        'gender',
        'TTL',
        'alamat',
        'phone',
        'email',
        'id_kelasindustri',
        'id_kelas',
        'id_jurusan',
        'angkatan',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'TTL' => 'date',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
