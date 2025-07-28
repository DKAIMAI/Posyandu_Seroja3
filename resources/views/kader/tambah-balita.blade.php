<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-lg font-semibold mb-4">Tambah Data Balita</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('kader.simpan-balita') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Orang Tua</label>
                <select name="user_id" class="mt-1 block w-full" required>
                    <option value="">-- Pilih --</option>
                    @foreach($orangtuas as $ortu)
                        <option value="{{ $ortu->user_id }}">{{ $ortu->nama_ortu }} - {{ $ortu->nik_ortu }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Anak ke</label>
                <input type="number" name="anak_ke" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Nomor KK</label>
                <input type="text" name="nomor_kk" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">NIK Balita</label>
                <input type="text" name="nik_balita" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Balita</label>
                <input type="text" name="nama_balita" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="mt-1 block w-full" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Berat Badan Lahir (kg)</label>
                <input type="number" step="0.01" name="bbl" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Panjang Badan Lahir (cm)</label>
                <input type="number" step="0.1" name="pbl" class="mt-1 block w-full" required>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
