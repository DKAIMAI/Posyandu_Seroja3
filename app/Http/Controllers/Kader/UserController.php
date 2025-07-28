<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('kader.tambah-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_ortu' => 'required|unique:users,nik_ortu|max:20',
            'nama_ortu' => 'required|max:50',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'required|max:15',
            'alamat' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
        ]);

        User::create([
            'nik_ortu' => $request->nik_ortu,
            'nama_ortu' => $request->nama_ortu,
            'password' => Hash::make($request->password),
            'role' => 'orangtua',
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        return redirect()->route('kader.tambah-user')->with('success', 'User berhasil ditambahkan!');
    }
}
