<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalitaOrangtua;
use App\Models\User;

class BalitaOrangtuaController extends Controller
{
    public function create()
    {
        $orangtuas = User::where('role', 'orangtua')->get();
        return view('kader.tambah-balita', compact('orangtuas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'anak_ke' => 'required|numeric|min:1',
            'nomor_kk' => 'required|string|max:30',
            'nik_balita' => 'required|string|max:20|unique:balita_orangtua,nik_balita',
            'nama_balita' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'bbl' => 'required|numeric|min:1',
            'pbl' => 'required|numeric|min:10',
        ]);

        BalitaOrangtua::create($request->all());

        return redirect()->route('kader.tambah-balita')->with('success', 'Data balita berhasil ditambahkan!');
    }
}
