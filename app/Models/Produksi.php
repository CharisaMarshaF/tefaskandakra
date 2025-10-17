<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = [
        'id_project',
        'id_kelasindustri',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'catatan',
    ];

    public function project(){
        return $this->belongsTo(Project::class,'id_project');
    }
    public function industri(){
        return $this->belongsTo(KelasIndustri::class,'id_kelasindustri');
    }
   
}
