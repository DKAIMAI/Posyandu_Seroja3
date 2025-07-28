<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanPosyandu extends Model
{
    protected $table = 'kegiatan_posyandu';
    protected $primaryKey = 'kegiatan_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kegiatan_id','tgl_ukur', 'usia_bulan', 'bb_balita', 'tb_balita', 'lila_balita',
        'status_kms', 'ntt_balita', 'lingkar_pinggang_ibu', 'bb_ibu', 'tb_ibu',
        'jenis_kb', 'vitamin_a', 'obat_cacing', 'balita_id'
    ];

    public function balita()
    {
        return $this->belongsTo(BalitaOrangtua::class, 'balita_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $prefix = now()->format('Ymd');
            $lastId = self::whereDate('created_at', today())
                        ->where('kegiatan_id', 'like', $prefix . '%')
                        ->max('kegiatan_id');

            $next = $lastId ? intval(substr($lastId, -3)) + 1 : 1;
            $model->kegiatan_id = $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
        });
    }
}
