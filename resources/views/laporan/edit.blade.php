<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-xl font-semibold mb-4">Edit Kegiatan Posyandu</h1>

        @if(session('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 5000)"
                x-show="show"
                x-transition
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4"
            >
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 7000)"
                x-show="show"
                x-transition
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4"
            >
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kader.kegiatan.update', $kegiatan->kegiatan_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label for="bb_balita" class="block">Berat Badan (kg):</label>
                    <input type="number" step="0.01" name="bb_balita" value="{{ $kegiatan->bb_balita }}" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="tb_balita" class="block">Tinggi Badan (cm):</label>
                    <input type="number" step="0.1" name="tb_balita" value="{{ $kegiatan->tb_balita }}" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="lila_balita" class="block">LILA Balita (cm)</label>
                    <input type="number" step="0.1" name="lila_balita" value="{{ $kegiatan->lila_balita }}" class="border rounded p-2 w-full">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label for="lingkar_pinggang_ibu" class="block">Lingkar Pinggang Ibu (cm)</label>
                    <input type="number" step="0.1" name="lingkar_pinggang_ibu" value="{{ $kegiatan->lingkar_pinggang_ibu }}" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="bb_ibu" class="block">Berat Badan Ibu (kg):</label>
                    <input type="number" step="0.01" name="bb_ibu" value="{{ $kegiatan->bb_ibu }}" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="tb_ibu" class="block">Tinggi Badan Ibu (cm):</label>
                    <input type="number" step="0.1" name="tb_ibu" value="{{ $kegiatan->tb_ibu }}" class="border rounded p-2 w-full">
                </div>
            </div>

            <div class="mb-4">
                <label for="jenis_kb" class="block text-sm font-medium text-gray-700">Jenis KB</label>
                <select name="jenis_kb" id="jenis_kb"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Pilih --</option>
                    <option value="Suntik" {{ $kegiatan->jenis_kb == 'Suntik' ? 'selected' : '' }}>Suntik</option>
                    <option value="Pil" {{ $kegiatan->jenis_kb == 'Pil' ? 'selected' : '' }}>Pil</option>
                    <option value="Implan" {{ $kegiatan->jenis_kb == 'Implan' ? 'selected' : '' }}>Implan</option>
                    <option value="IUD" {{ $kegiatan->jenis_kb == 'IUD' ? 'selected' : '' }}>IUD</option>
                    <option value="Tidak" {{ $kegiatan->jenis_kb == 'Tidak' ? 'selected' : '' }}>Tidak KB</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="vitamin_a" class="block text-sm font-medium text-gray-700">Vitamin A</label>
                <select name="vitamin_a" id="vitamin_a"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Pilih --</option>
                    <option value="Tidak diberikan" {{ $kegiatan->vitamin_a == 'Tidak diberikan' ? 'selected' : '' }}>-- Tidak diberikan --</option>
                    <option value="Merah" {{ $kegiatan->vitamin_a == 'Merah' ? 'selected' : '' }}>Merah</option>
                    <option value="Biru" {{ $kegiatan->vitamin_a == 'Biru' ? 'selected' : '' }}>Biru</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="obat_cacing" class="block text-sm font-medium text-gray-700">Obat Cacing</label>
                <select name="obat_cacing" id="obat_cacing"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Pilih --</option>
                    <option value="Diberikan" {{ $kegiatan->obat_cacing == 'Diberikan' ? 'selected' : '' }}>Diberikan</option>
                    <option value="Tidak" {{ $kegiatan->obat_cacing == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
