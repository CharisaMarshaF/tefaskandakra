<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'kode_project',
        'nama_project',
        'deskripsi',
        'id_guru',
        'id_perusahaan',
        'id_jurusan',
        'id_kelasindustri',
        'start_date',
        'deadline',
        'status',
        'expected_output',
    ];

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
