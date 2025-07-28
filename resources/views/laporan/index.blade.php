<x-app-layout>
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-xl font-semibold mb-4">Laporan Kegiatan Posyandu</h1>

        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4"
            >
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter Bulan --}}
        <form method="GET" class="mb-4 flex gap-2">
            <label for="bulan" class="font-medium">Pilih Bulan:</label>
            <input type="month" name="bulan" id="bulan" value="{{ $bulan }}" class="border p-1 rounded">
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
        </form>

        {{-- Tombol Export --}}
        <form method="GET" action="{{ route('kader.laporan.export') }}" class="mb-4">
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Export ke Excel</button>
        </form>

        {{-- Tabel --}}
        <div class="overflow-auto">
            <table class="w-full border text-sm text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Nama Balita</th>
                        <th class="border px-2 py-1">Anak ke</th>
                        <th class="border px-2 py-1">Tgl Lahir</th>
                        <th class="border px-2 py-1">Jenis Kelamin</th>
                        <th class="border px-2 py-1">No KK</th>
                        <th class="border px-2 py-1">NIK Balita</th>
                        <th class="border px-2 py-1">BBL</th>
                        <th class="border px-2 py-1">PBL</th>
                        <th class="border px-2 py-1">Nama Ortu</th>
                        <th class="border px-2 py-1">NIK Ortu</th>
                        <th class="border px-2 py-1">No HP</th>
                        <th class="border px-2 py-1">Alamat</th>
                        <th class="border px-2 py-1">RT/RW</th>
                        <th class="border px-2 py-1">Tgl Ukur</th>
                        <th class="border px-2 py-1">Usia (bulan)</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">TB</th>
                        <th class="border px-2 py-1">LILA</th>
                        <th class="border px-2 py-1">Status KMS</th>
                        <th class="border px-2 py-1">NTT</th>
                        <th class="border px-2 py-1">Vitamin A</th>
                        <th class="border px-2 py-1">Obat Cacing</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $item)
                        <tr>
                            <td class="border px-2 py-1">{{ $item->balita->nama_balita ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->anak_ke ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->tgl_lahir ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->jenis_kelamin ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->nomor_kk ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->nik_balita ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->bbl ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->pbl ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->user->nama_ortu ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->user->nik_ortu ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->user->no_hp ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->user->alamat ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->balita->user->rt ?? '-' }}/{{ $item->balita->user->rw ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->tgl_ukur ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->usia_bulan ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->bb_balita ?? '-' }} kg</td>
                            <td class="border px-2 py-1">{{ $item->tb_balita ?? '-' }} cm</td>
                            <td class="border px-2 py-1">{{ $item->lila_balita ?? '-' }} cm</td>
                            <td class="border px-2 py-1">{{ $item->status_kms ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->ntt_balita ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->vitamin_a ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $item->obat_cacing ?? '-' }}</td>
                            <td class="border px-2 py-1">
                                @if ($item->kegiatan_id && $item->balita)
                                    <a href="{{ route('kader.kegiatan.edit', $item->kegiatan_id) }}" class="text-blue-500 hover:underline">Edit</a>
                                @else
                                    <span class="text-red-500">Tidak bisa diedit</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="24" class="text-center border px-2 py-2">Tidak ada data untuk bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
