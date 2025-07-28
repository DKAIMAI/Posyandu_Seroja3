<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Data Kegiatan Posyandu
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Pilih Balita -->
                    <div>
                        <label for="balita_id" class="block font-medium text-sm text-gray-700">Pilih Balita</label>
                        <select name="balita_id" id="balita_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($balitas as $balita)
                                <option value="{{ $balita->balita_id }}">
                                    {{ $balita->nama_balita }} ({{ $balita->nik_balita }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Ukur -->
                    <div>
                        <label for="tgl_ukur" class="block font-medium text-sm text-gray-700">Tanggal Pengukuran</label>
                        <input type="date" name="tgl_ukur" id="tgl_ukur" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Berat, Tinggi, LILA -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="bb_balita" class="block font-medium text-sm text-gray-700">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="bb_balita" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="tb_balita" class="block font-medium text-sm text-gray-700">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="tb_balita" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="lila_balita" class="block font-medium text-sm text-gray-700">LILA (cm)</label>
                            <input type="number" step="0.1" name="lila_balita" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <!-- Usia Bulan, Status KMS, NTT Balita (Readonly) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="usia_bulan" class="block font-medium text-sm text-gray-700">Usia (bulan)</label>
                            <input type="number" name="usia_bulan" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" value="{{ old('usia_bulan') }}">
                        </div>
                        <div>
                            <label for="status_kms" class="block font-medium text-sm text-gray-700">Status KMS</label>
                            <input type="text" name="status_kms" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" value="{{ old('status_kms') }}">
                        </div>
                        <div>
                            <label for="ntt_balita" class="block font-medium text-sm text-gray-700">NTT Balita</label>
                            <input type="text" name="ntt_balita" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" value="{{ old('ntt_balita') }}">
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="lingkar_pinggang_ibu" class="block font-medium text-sm text-gray-700">Lingkar Pinggang Ibu (cm)</label>
                            <input type="number" step="0.1" name="lingkar_pinggang_ibu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="bb_ibu" class="block font-medium text-sm text-gray-700">Berat Badan Ibu (kg)</label>
                            <input type="number" step="0.1" name="bb_ibu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="tb_ibu" class="block font-medium text-sm text-gray-700">Tinggi Badan Ibu (cm)</label>
                            <input type="number" step="0.1" name="tb_ibu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <!-- KB, Vitamin, Obat -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Jenis KB -->
                        <div class="mb-4">
                            <label for="jenis_kb" class="block text-sm font-medium text-gray-700">Jenis KB</label>
                            <select name="jenis_kb" id="jenis_kb" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih --</option>
                                <option value="">Suntik</option>
                                <option value="Merah">Pil</option>
                                <option value="Biru">Implan</option>
                                <option value="Biru">IUD</option>
                                <option value="Biru">Tidak</option>
                            </select>
                        </div>
                        <!-- Vitamin A -->
                        <div class="mb-4">
                            <label for="vitamin_a" class="block text-sm font-medium text-gray-700">Vitamin A</label>
                            <select name="vitamin_a" id="vitamin_a" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih --</option>
                                <option value="">Tidak diberikan</option>
                                <option value="Merah">Merah</option>
                                <option value="Biru">Biru</option>
                            </select>
                        </div>
                        <!-- Obat Cacing -->
                        <div class="mb-4">
                            <label for="obat_cacing" class="block text-sm font-medium text-gray-700">Obat Cacing</label>
                            <select name="obat_cacing" id="obat_cacing" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih --</option>
                                <option value="Diberikan">Diberikan</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
