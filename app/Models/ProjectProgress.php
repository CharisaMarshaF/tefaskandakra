<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ProjectProgress extends Model
{

        use HasFactory;

    protected $table = 'project_progress';

    protected $fillable = [
        'id_project',
        'id_siswa',
        'tanggal',
        'progress_percent',
        'deskripsi',
        'file_id',
        'submitted_by',
    ];
    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }
}
