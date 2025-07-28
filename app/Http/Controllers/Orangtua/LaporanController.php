<?php

namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanPosyandu;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('Y-m');
        [$year, $month] = explode('-', $bulan);

        // Ambil balita yang dimiliki oleh user login
        $balitas = Auth::user()->balitas;

        // Ambil kegiatan berdasarkan bulan untuk balita tersebut
        $kegiatan = KegiatanPosyandu::with('balita.user')
            ->whereHas('balita', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->whereMonth('tgl_ukur', $month)
            ->whereYear('tgl_ukur', $year)
            ->get();

        return view('orangtua.laporan.index', compact('kegiatan', 'bulan'));
    }
}
