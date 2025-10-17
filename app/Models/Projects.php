<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
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
        return $this->belongsTo(guru::class, 'id_guru', 'id');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id');
    }
    public function kelasindustri()
    {
        return $this->belongsTo(KelasIndustri::class, 'id_kelasindustri', 'id');
    }
    public function projectgrade()
    {
        return $this->hasMany(ProjectGrade::class, 'id_project', 'id');
    }
    public function projectprogress()
    {
        return $this->hasMany(ProjectProgress::class, 'id_project', 'id');
    }
    public function projectmember()
    {
        return $this->hasMany(ProjectMember::class, 'id_project', 'id');
    }

        public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

        public function members()
    {
        return $this->hasMany(ProjectMember::class, 'id_project');
    }
    public function progress()
    {
        return $this->hasMany(ProjectProgress::class, 'id_project');
    }   
    
}
