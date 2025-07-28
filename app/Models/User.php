<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nik_ortu', 'nama_ortu', 'password', 'role', 'no_hp', 'alamat', 'rt', 'rw'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function balitas()
    {
        return $this->hasMany(BalitaOrangtua::class, 'user_id');
    }

    public function username()
    {
        return 'nik_ortu';
    }
}
