<?php

namespace App\Helpers;

class KmsHelper
{
    public static function getStatusKms($usia_bulan, $jenis_kelamin, $bb)
    {
        if ($jenis_kelamin === 'Laki-laki') {
            $jenis_kelamin = 'L';
        } elseif ($jenis_kelamin === 'Perempuan') {
            $jenis_kelamin = 'P';
        }
        $kms = [
            'L' => [
                0 => [2.5, 4.4], 1 => [3.4, 5.8], 2 => [4.4, 7.0], 3 => [5.1, 7.9],
                4 => [5.6, 8.6], 5 => [6.1, 9.2], 6 => [6.4, 9.7], 12 => [7.8, 11.8],
                24 => [9.7, 14.4], 36 => [11.3, 16.3], 48 => [12.7, 18.0], 60 => [14.1, 19.7]
            ],
            'P' => [
                0 => [2.4, 4.2], 1 => [3.2, 5.5], 2 => [4.0, 6.6], 3 => [4.6, 7.5],
                4 => [5.1, 8.2], 5 => [5.5, 8.8], 6 => [5.8, 9.3], 12 => [7.1, 11.3],
                24 => [9.2, 13.9], 36 => [10.8, 15.8], 48 => [12.3, 17.4], 60 => [13.7, 19.2]
            ]
        ];

        $usia_keys = array_keys($kms[$jenis_kelamin]);
        $terdekat = array_reduce($usia_keys, function ($carry, $item) use ($usia_bulan) {
            return abs($item - $usia_bulan) < abs($carry - $usia_bulan) ? $item : $carry;
        }, $usia_keys[0]);

        [$min, $max] = $kms[$jenis_kelamin][$terdekat];
        if ($bb < $min) return "Berat Badan Kurang";
        if ($bb > $max) return "Risiko Obesitas";
        return "Normal";
    }
}
