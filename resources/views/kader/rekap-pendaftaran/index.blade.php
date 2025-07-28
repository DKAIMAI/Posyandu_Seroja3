<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Rekap Pendaftaran Posyandu
        </h2>
    </x-slot>

    <div class="p-4">
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Nama Balita</th>
                        <th class="px-4 py-2">Orang Tua</th>
                        <th class="px-4 py-2">Status Hadir</th>
                        <th class="px-4 py-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $data)
                        <tr>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($data->tgl_daftar)->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $data->balita->nama_balita ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $data->balita->user->nama_ortu ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($data->status_hadir) }}</td>
                            <td class="border px-4 py-2">{{ $data->ket ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-2">Belum ada data pendaftaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
