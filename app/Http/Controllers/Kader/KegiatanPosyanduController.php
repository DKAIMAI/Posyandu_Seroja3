<?php

namespace App\Http\Controllers\Kader;

use App\Helpers\KmsHelper;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalitaOrangtua;
use App\Models\KegiatanPosyandu;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKegiatanExport;

class KegiatanPosyanduController extends Controller
{
    public function create()
    {
        $balitas = BalitaOrangtua::with('user')->get();
        return view('kader.kegiatan.create', compact('balitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'balita_id' => 'required',
            'tgl_ukur' => 'required|date',
            'bb_balita' => 'required|numeric',
            'tb_balita' => 'required|numeric',
            'lila_balita' => 'required|numeric',
            'lingkar_pinggang_ibu' => 'nullable|numeric',
            'bb_ibu' => 'nullable|numeric',
            'tb_ibu' => 'nullable|numeric',
            'jenis_kb' => 'nullable|string',
            'vitamin_a' => 'nullable|in:Merah,Biru',
            'obat_cacing' => 'nullable|in:Diberikan,Tidak',
        ]);

        $balita = BalitaOrangtua::findOrFail($request->balita_id);

        $usia_bulan = Carbon::parse($request->tgl_ukur)->diffInMonths(Carbon::parse($balita->tgl_lahir));
        $status_kms = KmsHelper::getStatusKms($usia_bulan, $balita->jenis_kelamin, $request->bb_balita);

        $riwayat = KegiatanPosyandu::where('balita_id', $request->balita_id)
            ->orderByDesc('tgl_ukur')->first();

        $ntt_balita = '-';
        if ($riwayat) {
            if ($request->bb_balita > $riwayat->bb_balita) $ntt = 'Naik';
            elseif ($request->bb_balita < $riwayat->bb_balita) $ntt = 'Turun';
            else $ntt = 'Tetap';
        }

        try {
            KegiatanPosyandu::create([
                'kegiatan_id' => $this->generateKegiatanId(),
                'balita_id' => $request->balita_id,
                'tgl_ukur' => $request->tgl_ukur,
                'usia_bulan' => $usia_bulan,
                'bb_balita' => $request->bb_balita,
                'tb_balita' => $request->tb_balita,
                'lila_balita' => $request->lila_balita,
                'status_kms' => $status_kms,
                'ntt_balita' => $ntt_balita,
                'lingkar_pinggang_ibu' => $request->lingkar_pinggang_ibu,
                'bb_ibu' => $request->bb_ibu,
                'tb_ibu' => $request->tb_ibu,
                'jenis_kb' => $request->jenis_kb,
                'vitamin_a' => $request->vitamin_a,
                'obat_cacing' => $request->obat_cacing,
            ]);

            return redirect()->back()->with('success', 'Data kegiatan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data. ' . $e->getMessage());
        }
    }

    private function generateKegiatanId()
    {
        $prefix = now()->format('Ymd');
        $last = KegiatanPosyandu::where('kegiatan_id', 'like', $prefix . '%')->count() + 1;
        return $prefix . str_pad($last, 3, '0', STR_PAD_LEFT);
    }
    public function laporan(Request $request)
    {
        $query = KegiatanPosyandu::with('balita.user');

        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_ukur', Carbon::parse($request->bulan)->month)
                ->whereYear('tgl_ukur', Carbon::parse($request->bulan)->year);
        }

        if ($request->filled('search')) {
            $query->whereHas('balita', function ($q) use ($request) {
                $q->where('nama_balita', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->orderBy('tgl_ukur', 'desc')->paginate(10);
        return view('kader.laporan.kegiatan', compact('data'));
    }

    public function export(Request $request)
    {
        return Excel::download(new LaporanKegiatanExport($request->bulan), 'laporan-kegiatan.xlsx');
    }

    public function edit($id)
    {
        $data = KegiatanPosyandu::findOrFail($id);
        return view('kader.kegiatan.edit', compact('data'));
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
    }
}
