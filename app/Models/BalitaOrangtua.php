<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalitaOrangtua extends Model
{
    protected $table = 'balita_orangtua';
    protected $primaryKey = 'balita_id';

    protected $fillable = [
        'anak_ke', 'nomor_kk', 'nik_balita', 'nama_balita', 'tgl_lahir', 
        'jenis_kelamin', 'bbl', 'pbl', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->hasMany(KegiatanPosyandu::class, 'balita_id');
    }
}
