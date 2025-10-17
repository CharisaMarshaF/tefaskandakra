<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGrade extends Model
{
    protected $guarded = ['id'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }
    public function file()
    {
        return $this->belongsTo(File::class, 'sertifikat_file_id', 'id');
    }
    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by', 'id');
    }
}
