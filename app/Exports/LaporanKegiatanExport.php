<?php

namespace App\Exports;

use App\Models\KegiatanPosyandu;
use Maatwebsite\Excel\Concerns\{
    FromCollection, WithHeadings, WithMapping, ShouldAutoSize,
    WithStyles, WithColumnFormatting
};
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanKegiatanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return KegiatanPosyandu::with(['balita.user'])
            ->whereMonth('tgl_ukur', date('m', strtotime($this->bulan)))
            ->whereYear('tgl_ukur', date('Y', strtotime($this->bulan)))
            ->get();
    }

    public function map($item): array
    {
        return [
            $item->balita->nama_balita ?? '-',
            $item->balita->anak_ke ?? '-',
            $item->balita->tgl_lahir ?? '-',
            $item->balita->jenis_kelamin ?? '-',
            $item->balita->nomor_kk ?? '-',
            $item->balita->nik_balita ?? '-',
            $item->balita->bbl ?? '-',
            $item->balita->pbl ?? '-',
            $item->balita->user->nama_ortu ?? '-',
            $item->balita->user->nik_ortu ?? '-',
            $item->balita->user->no_hp ?? '-',
            $item->balita->user->alamat ?? '-',
            $item->balita->user->rt ?? '-',
            $item->balita->user->rw ?? '-',
            $item->tgl_ukur ?? '-',
            $item->usia_bulan ?? '-',
            $item->bb_balita ?? '-',
            $item->tb_balita ?? '-',
            $item->lila_balita ?? '-',
            $item->status_kms ?? '-',
            $item->ntt_balita ?? '-',
            $item->vitamin_a ?? '-',
            $item->obat_cacing ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Balita', 'Anak Ke', 'Tgl Lahir', 'Jenis Kelamin', 'Nomor KK',
            'NIK Balita', 'BBL', 'PBL', 'Nama Ortu', 'NIK Ortu', 'No HP', 'Alamat',
            'RT', 'RW', 'Tgl Ukur', 'Usia (bln)', 'BB', 'TB', 'LILA', 'Status KMS',
            'NTT', 'Vitamin A', 'Obat Cacing'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
            'S' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
