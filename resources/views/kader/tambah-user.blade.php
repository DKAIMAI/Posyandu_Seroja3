<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-lg font-semibold mb-4">Tambah User Orang Tua</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('kader.simpan-user') }}">
            @csrf

            <div class="mb-4">
                <label for="nik_ortu" class="block text-sm font-medium">NIK</label>
                <input type="text" name="nik_ortu" class="mt-1 block w-full" required>
                @error('nik_ortu') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="nama_ortu" class="block text-sm font-medium">Nama Orang Tua</label>
                <input type="text" name="nama_ortu" class="mt-1 block w-full" required>
                @error('nama_ortu') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="mt-1 block w-full" required>
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block text-sm font-medium">No HP</label>
                <input type="text" name="no_hp" class="mt-1 block w-full" required>
                @error('no_hp') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" rows="2" class="mt-1 block w-full" required></textarea>
                @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4 mb-4">
                <div>
                    <label for="rt" class="block text-sm font-medium">RT</label>
                    <input type="text" name="rt" class="mt-1 block w-full" required>
                    @error('rt') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="rw" class="block text-sm font-medium">RW</label>
                    <input type="text" name="rw" class="mt-1 block w-full" required>
                    @error('rw') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
