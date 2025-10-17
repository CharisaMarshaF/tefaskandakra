<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';

    protected $fillable = [
        'foto',
    ];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id_foto');
    }
}
