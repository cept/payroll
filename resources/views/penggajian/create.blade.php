<x-layout>
    <x-slot:title>{{ $title = 'Penggajian' }}</x-slot:title>
    
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full mx-auto" x-data="karyawanGaji()">
        <h2 class="text-2xl font-semibold mb-4 text-center">Tambah Data Penggajian</h2>

        <form action="{{ route('penggajian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="periode_gaji" class="block text-sm font-medium text-gray-700">Periode Gaji</label>
                <input type="text" id="periode_gaji" name="periode_gaji" class="mt-1 p-2 w-full border rounded-md @error('periode_gaji') border-red-500 @enderror" value="{{ old('periode_gaji') }}">
                @error('periode_gaji')
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
                <label for="kode_karyawan" class="block text-sm font-medium text-gray-700">Kode Karyawan</label>
                <input list="karyawanList" id="kode_karyawan" name="kode_karyawan" class="mt-1 p-2 w-full border rounded-md @error('kode_karyawan') border-red-500 @enderror" value="{{ old('kode_karyawan') }}" x-model="kodeKaryawan" @input="fetchGajiDetails">
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
                <label for="gaji_pokok" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" class="mt-1 p-2 w-full border rounded-md @error('gaji_pokok') border-red-500 @enderror" x-model="gajiPokok" readonly>
                @error('gaji_pokok')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-4">
                <label for="tunj_transport" class="block text-sm font-medium text-gray-700">Tunjangan Transport</label>
                <input type="number" id="tunj_transport" name="tunj_transport" class="mt-1 p-2 w-full border rounded-md @error('tunj_transport') border-red-500 @enderror" x-model="tunjTransport" readonly>
                @error('tunj_transport')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-4">
                <label for="tunj_makan" class="block text-sm font-medium text-gray-700">Tunjangan Makan</label>
                <input type="number" id="tunj_makan" name="tunj_makan" class="mt-1 p-2 w-full border rounded-md @error('tunj_makan') border-red-500 @enderror" x-model="tunjMakan" readonly>
                @error('tunj_makan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="total_lembur" class="block text-sm font-medium text-gray-700">Total Lembur</label>
                <input type="number" id="total_lembur" name="total_lembur" class="mt-1 p-2 w-full border rounded-md @error('total_lembur') border-red-500 @enderror" x-model="totalLembur" readonly>
                @error('total_lembur')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="ptkp" class="block text-sm font-medium text-gray-700">Penghasilan Tidak Kena Pajak (PTKP)</label>
                <span class="text-xs">PTKP Tidak Kawin: 54.000.000, PTKP Kawin, Anak 1: 54.000.000+4.500.000+4.500.000</span>
                <input type="number" id="ptkp" name="ptkp" class="mt-1 p-2 w-full border rounded-md @error('ptkp') border-red-500 @enderror" x-model="ptkp" value="{{ old('ptkp') }}" placeholder="54000000">
                @error('ptkp')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-4">
                <label for="total_bonus" class="block text-sm font-medium text-gray-700">Total Bonus</label>
                <input type="number" id="total_bonus" name="total_bonus" class="mt-1 p-2 w-full border rounded-md @error('total_bonus') border-red-500 @enderror" value="{{ old('total_bonus') }}" placeholder="100000">
                @error('total_bonus')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="total_pinjaman" class="block text-sm font-medium text-gray-700">Total Pinjaman</label>
                <input type="number" id="total_pinjaman" name="total_pinjaman" class="mt-1 p-2 w-full border rounded-md @error('total_pinjaman') border-red-500 @enderror" x-model="totalPinjaman" readonly>
                @error('total_pinjaman')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-6">
                <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function karyawanGaji() {
            return {
                kodeKaryawan: '',
                gajiPokok: '',
                tunjTransport: '',
                tunjMakan: '',
                totalLembur: '',
                totalPinjaman: '',

                fetchGajiDetails() {
                    if (this.kodeKaryawan) {
                        fetch(`/karyawan/${this.kodeKaryawan}/gaji`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.gaji_pokok !== undefined) {
                                    this.gajiPokok = data.gaji_pokok;
                                    this.tunjTransport = data.tunj_transport;
                                    this.tunjMakan = data.tunj_makan;
                                } else {
                                    this.gajiPokok = '';
                                    this.tunjTransport = '';
                                    this.tunjMakan = '';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.gajiPokok = '';
                                this.tunjTransport = '';
                                this.tunjMakan = '';
                            });

                        // Fetch total lembur
                        fetch(`/karyawan/${this.kodeKaryawan}/lembur`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.total_lembur !== undefined) {
                                    this.totalLembur = data.total_lembur;
                                } else {
                                    this.totalLembur = '';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.totalLembur = '';
                            });
                

                        // Fetch total pinjaman
                        fetch(`/karyawan/${this.kodeKaryawan}/pinjaman`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.total_pinjaman !== undefined) {
                                    this.totalPinjaman = data.total_pinjaman;
                                } else {
                                    this.totalPinjaman = '';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.totalPinjaman = '';
                            });
                    } else {
                        this.gajiPokok = '';
                        this.tunjTransport = '';
                        this.tunjMakan = '';
                        this.totalLembur = '';
                        this.totalPinjaman = '';
                    }
                }
            }
        }
    </script>
</x-layout>
