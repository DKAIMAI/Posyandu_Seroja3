<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PendaftaranPosyandu extends Model
{
    protected $table = 'pendaftaran_posyandu';
    protected $primaryKey = 'pendaftaran_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pendaftaran_id',
        'balita_id',
        'tgl_daftar',
        'status_hadir',
        'ket'
    ];

    public function balita()
    {
        return $this->belongsTo(BalitaOrangtua::class, 'balita_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $prefix = now()->format('Ymd'); // contoh: 20250724
            $lastId = self::whereDate('created_at', today())
                        ->where('pendaftaran_id', 'like', $prefix . '%')
                        ->max('pendaftaran_id');

            $next = $lastId ? intval(substr($lastId, -3)) + 1 : 1;
            $model->pendaftaran_id = $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
        });
    }
}
