<x-layout>
    <x-slot:title>{{ $title = 'Karyawan'; }}</x-slot:title>
		
    
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full mx-auto">
        <h2 class="text-2xl font-semibold mb-4 text-center">Edit Data Karyawan</h2>

        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <label for="kode_karyawan" class="block text-sm font-medium text-gray-700">Kode Karyawan</label>
                <input type="text" id="kode_karyawan" name="kode_karyawan" class="mt-1 p-2 w-full border rounded-md @error('kode_karyawan') border-red-500 @enderror" value="{{ old('kode_karyawan', $karyawan->kode_karyawan) }}" readonly>
                @error('kode_karyawan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="number" id="nik" name="nik" class="mt-1 p-2 w-full border rounded-md @error('nik') border-red-500 @enderror" value="{{ old('nik', $karyawan->nik) }}">
                @error('nik')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="nama_karyawan" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                <input type="text" id="nama_karyawan" name="nama_karyawan" class="mt-1 p-2 w-full border rounded-md @error('nama_karyawan') border-red-500 @enderror" value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}">
                @error('nama_karyawan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="kode_bagian" class="block text-sm font-medium text-gray-700">Bagian</label>
                <select id="kode_bagian" name="kode_bagian" class="mt-1 p-2 w-full border rounded-md @error('kode_bagian') border-red-500 @enderror">
                    <option value="" disabled selected>Pilih Bagian</option>
                    @foreach($bagians as $bagian)
                        <option value="{{ $bagian->kode_bagian }}" {{ old('kode_bagian', $karyawan->kode_bagian) == $bagian->kode_bagian ? 'selected' : '' }}>
                            {{ $bagian->nama_bagian }}
                        </option>
                    @endforeach
                </select>
                @error('kode_bagian')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select id="kelamin" name="kelamin" class="mt-1 p-2 w-full border rounded-md @error('kelamin') border-red-500 @enderror">
                <option value="" disabled {{ old('kelamin', $karyawan->kelamin) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('kelamin', $karyawan->kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('kelamin', $karyawan->kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
                @error('kelamin')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="mt-1 p-2 w-full border rounded-md @error('alamat') border-red-500 @enderror" value="{{ old('alamat', $karyawan->alamat) }}">
                @error('alamat')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="number" id="no_hp" name="no_hp" class="mt-1 p-2 w-full border rounded-md @error('no_hp') border-red-500 @enderror" value="{{ old('no_hp', $karyawan->no_hp) }}">
                @error('no_hp')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="mt-1 p-2 w-full border rounded-md @error('tempat_lahir') border-red-500 @enderror" value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
                @error('tempat_lahir')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 p-2 w-full border rounded-md @error('tgl_lahir') border-red-500 @enderror" value="{{ old('tgl_lahir', $karyawan->tgl_lahir->format('Y-m-d')) }}">
                @error('tgl_lahir')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                <input type="text" id="agama" name="agama" class="mt-1 p-2 w-full border rounded-md @error('agama') border-red-500 @enderror" value="{{ old('agama', $karyawan->agama) }}">
                @error('agama')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" id="status" name="status" class="mt-1 p-2 w-full border rounded-md @error('status') border-red-500 @enderror" value="{{ old('status', $karyawan->status) }}">
                @error('status')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="tgl_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                <input type="date" id="tgl_masuk" name="tgl_masuk" class="mt-1 p-2 w-full border rounded-md @error('tgl_masuk') border-red-500 @enderror" value="{{ old('tgl_masuk', $karyawan->tgl_masuk->format('Y-m-d')) }}">
                @error('tgl_masuk')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-layout>