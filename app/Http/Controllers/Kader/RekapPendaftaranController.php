<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranPosyandu;
use Illuminate\Http\Request;

class RekapPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $pendaftarans = PendaftaranPosyandu::with('balita.user')
            ->orderBy('tgl_daftar', 'desc')
            ->get();

        return view('kader.rekap-pendaftaran.index', compact('pendaftarans'));
    }
}
