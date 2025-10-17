<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Projects::class, 'id_project', 'id');
    }
}
