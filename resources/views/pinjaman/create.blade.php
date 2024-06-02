<x-layout>
    <x-slot:title>{{ $title = 'Pinjaman' }}</x-slot:title>

    <div class="bg-white p-8 rounded shadow-md max-w-md w-full mx-auto">
        <h2 class="text-2xl font-semibold mb-4 text-center">Tambah Data Pinjaman</h2>

        <form action="{{ route('pinjaman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="kode_karyawan" class="block text-sm font-medium text-gray-700">Kode Karyawan</label>
                <input list="karyawanList" id="kode_karyawan" name="kode_karyawan" class="mt-1 p-2 w-full border rounded-md @error('kode_karyawan') border-red-500 @enderror" value="{{ old('kode_karyawan') }}">
                <datalist id="karyawanList">
                    <option value="" disabled>Pilih Kode Karyawan</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->kode_karyawan }}">{{ $karyawan->nama_karyawan }}</option>
                    @endforeach
                </datalist>
                @error('kode_karyawan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="mt-1 p-2 w-full border rounded-md @error('tanggal') border-red-500 @enderror" value="{{ old('tanggal') }}">
                @error('tanggal')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="besar_pinjaman" class="block text-sm font-medium text-gray-700">Besar Pinjaman</label>
                <input type="number" id="besar_pinjaman" name="besar_pinjaman" class="mt-1 p-2 w-full border rounded-md @error('besar_pinjaman') border-red-500 @enderror" value="{{ old('besar_pinjaman') }}">
                @error('besar_pinjaman')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="mt-1 p-2 w-full border rounded-md @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-4">
                <label for="status_lunas" class="block text-sm font-medium text-gray-700">Status Lunas</label>
                <select id="status_lunas" name="status_lunas" class="mt-1 p-2 w-full border rounded-md @error('status_lunas') border-red-500 @enderror">
                    <option value="" disabled selected>Pilih Status Lunas</option>
                    <option value="Lunas" {{ old('status_lunas') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Belum Lunas" {{ old('status_lunas') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
                @error('status_lunas')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-layout>