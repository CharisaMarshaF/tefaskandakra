<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperationRequest extends Model
{
    use HasFactory;

    protected $table = 'cooperation_requests';

    protected $fillable = [
        'nama_perusahaan',
        'kode_tiket',
        'alamat_perusahaan',
        'bidang_usaha',
        'kontak_person',
        'no_telp',
        'email',
        'jenis_kerjasama',
        'deskripsi_kebutuhan',
        'id_file',
        'status',
        'catatan_admin',
        'tanggal_pengajuan',
        'tanggal_update',
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'id_file');
    }
}
