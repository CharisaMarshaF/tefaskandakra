<?php

namespace App\Models;

// ...

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // ...

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'id_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Tambahkan method ini untuk memberitahu Laravel bahwa kolom yang digunakan untuk login adalah 'username'
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_user', 'id');
    }
}
