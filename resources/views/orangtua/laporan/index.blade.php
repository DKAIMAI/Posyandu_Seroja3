<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-xl font-bold mb-4">Laporan Kegiatan Posyandu Anak Anda</h1>

        <form method="GET" class="mb-4">
            <label for="bulan">Pilih Bulan:</label>
            <input type="month" name="bulan" id="bulan" value="{{ $bulan }}" class="border rounded p-1">
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Filter</button>
        </form>

        @if ($kegiatan->count() > 0)
            <table class="table-auto w-full border text-sm">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Nama Balita</th>
                        <th class="border px-2 py-1">Tanggal Ukur</th>
                        <th class="border px-2 py-1">Usia (bulan)</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">TB</th>
                        <th class="border px-2 py-1">LILA</th>
                        <th class="border px-2 py-1">Status KMS</th>
                        <th class="border px-2 py-1">NTT</th>
                        <th class="border px-2 py-1">Vitamin A</th>
                        <th class="border px-2 py-1">Obat Cacing</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $item)
                        <tr>
                            <td class="border px-2 py-1">{{ $item->balita->nama_balita }}</td>
                            <td class="border px-2 py-1">{{ $item->tgl_ukur }}</td>
                            <td class="border px-2 py-1">{{ $item->usia_bulan }}</td>
                            <td class="border px-2 py-1">{{ $item->bb_balita }} kg</td>
                            <td class="border px-2 py-1">{{ $item->tb_balita }} cm</td>
                            <td class="border px-2 py-1">{{ $item->lila_balita }} cm</td>
                            <td class="border px-2 py-1">{{ $item->status_kms }}</td>
                            <td class="border px-2 py-1">{{ $item->ntt_balita }}</td>
                            <td class="border px-2 py-1">{{ $item->vitamin_a ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->obat_cacing ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">Tidak ada data kegiatan untuk bulan ini.</p>
        @endif
    </div>
</x-app-layout>
