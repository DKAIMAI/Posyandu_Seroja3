<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanPosyandu;
use App\Models\BalitaOrangtua;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKegiatanExport;
use Carbon\Carbon;

class LaporanKegiatanController extends Controller
{
    public function orangtua()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));
        [$tahun, $bulanAngka] = explode('-', $bulan);

        $kegiatan = KegiatanPosyandu::with(['balita.user']) // akses ke balita dan ortu
            ->whereMonth('tgl_ukur', $bulanAngka)
            ->whereYear('tgl_ukur', $tahun)
            ->get();

        return view('laporan.index', compact('kegiatan', 'bulan'));
    }

    public function show(BalitaOrangtua $balita)
    {
        $kegiatan = $balita->kegiatanPosyandu()->latest()->get();
        return view('laporan.show', compact('balita', 'kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = \App\Models\KegiatanPosyandu::with('balita.user')->findOrFail($id);

        return view('laporan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanPosyandu::findOrFail($id);

        $request->validate([
            'bb_balita' => 'required|numeric',
            'tb_balita' => 'required|numeric',
            'lila_balita' => 'required|numeric',
            'lingkar_pinggang_ibu' => 'nullable|numeric',
            'bb_ibu' => 'nullable|numeric',
            'tb_ibu' => 'nullable|numeric',
            'jenis_kb' => 'nullable|string',
            'vitamin_a' => 'nullable|in:Merah,Biru,Tidak Diberikan',
            'obat_cacing' => 'nullable|in:Diberikan,Tidak',
        ]);

        try {
            $kegiatan = KegiatanPosyandu::findOrFail($id);

        $kegiatan->update($request->only([
            'bb_balita',
            'tb_balita',
            'lila_balita',
            'lingkar_pinggang_ibu',
            'bb_ibu',
            'tb_ibu',
            'jenis_kb',
            'vitamin_a',
            'obat_cacing',
        ]));

        return redirect()->route('kader.laporan.kegiatan')->with('success', 'Data berhasil diperbarui.');
        }catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan');
        return Excel::download(new LaporanKegiatanExport($bulan), 'Laporan-Kegiatan-Balita-'.$bulan.'.xlsx');
    }
}
