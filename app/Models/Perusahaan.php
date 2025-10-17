<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'id_user',
        'kode_perusahaan',
        'nama',
        'pic_name',
        'pic_phone',
        'pic_email',
        'website',
        'bidang_usaha',
        'kontak_person',
        'jabatan_kontak_person',
    ];
}
