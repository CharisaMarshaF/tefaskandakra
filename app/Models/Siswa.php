<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function kelasIndustri()
    {
        return $this->belongsTo(KelasIndustri::class, 'id_kelasindustri');
    }


    public function orangTua()
    {
        return $this->hasMany(OrangTua::class, 'id_siswa');
    }

    public function pengajuanKelasIndustri()
    {
        return $this->hasMany(PengajuanKelasIndustri::class, 'id_siswa');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'id_siswa', 'id_project')
                    ->withPivot('role', 'assigned_at')
                    ->withTimestamps();
    }
}
