<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    protected $table = 'jadwal_produksi';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'id_project');
    }
    public function kelasindustri()
    {
        return $this->belongsTo(KelasIndustri::class, 'id_kelasindustri');
    }

}
