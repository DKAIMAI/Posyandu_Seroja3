<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-lg font-semibold mb-4">Form Pendaftaran Posyandu</h2>

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

        <form method="POST" action="{{ route('pendaftaran.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Balita</label>
                <select name="balita_id" required class="mt-1 block w-full">
                    <option value="">-- Pilih --</option>
                    @foreach($balitas as $balita)
                        <option value="{{ $balita->balita_id }}" {{ old('balita_id') == $balita->balita_id ? 'selected' : '' }}>
                            {{ $balita->nama_balita }} - {{ $balita->user->nama_ortu ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Status Kehadiran</label>
                <select name="status_hadir" required class="mt-1 block w-full">
                    <option value="">-- Pilih --</option>
                    <option value="hadir" {{ old('status_hadir') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="tidak hadir" {{ old('status_hadir') == 'tidak hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Keterangan (jika tidak hadir)</label>
                <textarea name="ket" class="mt-1 block w-full" rows="2">{{ old('ket') }}</textarea>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Daftar</button>
        </form>
    </div>
</x-app-layout>
