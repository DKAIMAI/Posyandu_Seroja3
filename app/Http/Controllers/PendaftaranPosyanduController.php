<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranPosyandu;
use App\Models\BalitaOrangtua;
use Illuminate\Support\Facades\Auth;

class PendaftaranPosyanduController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $isKader = $user->role === 'kader';

        if ($isKader) {
            $balitas = BalitaOrangtua::with('user')->get();
        } else {
            $balitas = BalitaOrangtua::where('user_id', $user->user_id)->get();
        }

        return view('pendaftaran.form', compact('balitas', 'isKader'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'balita_id' => 'required|exists:balita_orangtua,balita_id',
            'status_hadir' => 'required|in:terdaftar,hadir,tidak hadir',
            'ket' => 'nullable|string',
        ]);

        try {
        PendaftaranPosyandu::create([
            'balita_id' => $request->balita_id,
            'tgl_daftar' => now(),
            'status_hadir' => $request->status_hadir,
            'ket' => $request->ket,
        ]);

        return redirect()->route('pendaftaran.create')->with('success', 'Pendaftaran berhasil!');
        } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', 'Gagal menyimpan data. Pesan: ' . $e->getMessage());
        }
    }

}
