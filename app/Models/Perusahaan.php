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

        public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class, 'id_perusahaan');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'id_perusahaan');
    }

        public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function kelasIndustri()
    {
        return $this->belongsTo(KelasIndustri::class, 'id_kelasindustri');
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class, 'id_project');
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class, 'id_project');
    }

    public function grades()
    {
        return $this->hasMany(ProjectGrade::class, 'id_project');
    }

    public function jadwalProduksi()
    {
        return $this->hasOne(JadwalProduksi::class, 'id_project');
    }
}
