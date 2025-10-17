<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'nama_file',
        'file_type',
        'file_path',
        'uploaded_at',
    ];

    public function cooperationRequests()
    {
        return $this->hasMany(CooperationRequest::class, 'id_file');
    }

    public function csTickets()
    {
        return $this->hasMany(CSTicket::class, 'id_file');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bukti_file_id');
    }

    public function projectProgress()
    {
        return $this->hasMany(ProjectProgress::class, 'file_id');
    }

    public function projectGrades()
    {
        return $this->hasMany(ProjectGrade::class, 'sertifikat_file_id');
    }
}
