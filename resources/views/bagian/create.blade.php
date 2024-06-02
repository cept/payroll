<x-layout>
    <x-slot:title>{{ $title = 'Bagian'; }}</x-slot:title>
		
    {{-- <h1>Tambah Data Bagian</h1> --}}
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full mx-auto">
        <h2 class="text-2xl font-semibold mb-4 text-center">Tambah Data Bagian</h2>

        <form action="{{ route('bagian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="kode_bagian" class="block text-sm font-medium text-gray-700">Kode Bagian</label>
                <input type="text" id="kode_bagian" name="kode_bagian" class="mt-1 p-2 w-full border rounded-md @error('kode_bagian') border-red-500 @enderror" value="{{ old('kode_bagian') }}" placeholder="ADM01">
                @error('kode_bagian')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="nama_bagian" class="block text-sm font-medium text-gray-700">Nama Bagian</label>
                <input type="text" id="nama_bagian" name="nama_bagian" class="mt-1 p-2 w-full border rounded-md @error('nama_bagian') border-red-500 @enderror" value="{{ old('nama_bagian') }}" placeholder="Administrasi">
                @error('nama_bagian')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="gaji_pokok" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" class="mt-1 p-2 w-full border rounded-md @error('gaji_pokok') border-red-500 @enderror" value="{{ old('gaji_pokok') }}" placeholder="3000000">
                @error('gaji_pokok')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="uang_transport" class="block text-sm font-medium text-gray-700">Uang Transport</label>
                <input type="number" id="uang_transport" name="uang_transport" class="mt-1 p-2 w-full border rounded-md @error('uang_transport') border-red-500 @enderror" value="{{ old('uang_transport') }}" placeholder="300000">
                @error('uang_transport')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="uang_makan" class="block text-sm font-medium text-gray-700">Uang Makan</label>
                <input type="number" id="uang_makan" name="uang_makan" class="mt-1 p-2 w-full border rounded-md @error('uang_makan') border-red-500 @enderror" value="{{ old('uang_makan') }}" placeholder="300000">
                @error('uang_makan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="uang_lembur" class="block text-sm font-medium text-gray-700">Uang Lembur</label>
                <input type="number" id="uang_lembur" name="uang_lembur" class="mt-1 p-2 w-full border rounded-md @error('uang_lembur') border-red-500 @enderror" value="{{ old('uang_lembur') }}" placeholder="100000">
                @error('uang_lembur')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="bpjs_kesehatan" class="block text-sm font-medium text-gray-700">BPJS Kesehatan</label>
                <input type="text" id="bpjs_kesehatan" name="bpjs_kesehatan" class="mt-1 p-2 border rounded-md @error('bpjs_kesehatan') border-red-500 @enderror" value="{{ old('bpjs_kesehatan') }}" placeholder="4">
                <p class="inline-block border-gray-200 bg-gray-100 p-2 border rounded-md">%</p>
                @error('bpjs_kesehatan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="bpjs_jkk" class="block text-sm font-medium text-gray-700">BPJS Jaminan Kecelakaan Kerja (JKK)</label>
                <input type="text" id="bpjs_jkk" name="bpjs_jkk" class="mt-1 p-2 border rounded-md @error('bpjs_jkk') border-red-500 @enderror" value="{{ old('bpjs_jkk') }}" placeholder="0.24">
                <p class="inline-block border-gray-200 bg-gray-100 p-2 border rounded-md">%</p>
                @error('bpjs_jkk')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="bpjs_jkm" class="block text-sm font-medium text-gray-700">BPJS Jaminan Kematian (JKM)</label>
                <input type="text" id="bpjs_jkm" name="bpjs_jkm" class="mt-1 p-2 border rounded-md @error('bpjs_jkm') border-red-500 @enderror" value="{{ old('bpjs_jkm') }}" placeholder="0.3">
                <p class="inline-block border-gray-200 bg-gray-100 p-2 border rounded-md">%</p>
                @error('bpjs_jkm')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="bpjs_jht" class="block text-sm font-medium text-gray-700">BPJS Jaminan Hari Tua (JHT)</label>
                <input type="text" id="bpjs_jht" name="bpjs_jht" class="mt-1 p-2 border rounded-md @error('bpjs_jht') border-red-500 @enderror" value="{{ old('bpjs_jht') }}" placeholder="2">
                <p class="inline-block border-gray-200 bg-gray-100 p-2 border rounded-md">%</p>
                @error('bpjs_jht')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="bpjs_jp" class="block text-sm font-medium text-gray-700">BPJS Jaminan Pensiunan (JP)</label>
                <input type="text" id="bpjs_jp" name="bpjs_jp" class="mt-1 p-2 border rounded-md @error('bpjs_jp') border-red-500 @enderror" value="{{ old('bpjs_jp') }}" placeholder="1">
                <p class="inline-block border-gray-200 bg-gray-100 p-2 border rounded-md">%</p>
                @error('bpjs_jp')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-layout>