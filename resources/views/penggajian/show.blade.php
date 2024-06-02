<x-layout>
    <x-slot:title>{{ $title = 'Penggajian' }}</x-slot:title>

    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
            <div class="mt-2 mb-8 w-full">
                <a href="{{ route('penggajian.index') }}" class="font-medium text-blue-600 hover:underline mb-3 block">Kembali</a>
                <a href="{{ route('penggajian.export', $penggajian->id) }}" class="px-4 py-2 bg-emerald-500 rounded-md text-emerald-50 hover:bg-emerald-600">Export</a>
                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-white text-center">
                    Nota Gaji
                </h4>
            </div> 
            <div class="grid grid-cols-2 gap-4 px-2 w-full">
                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Periode Gaji</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $penggajian->periode_gaji }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Tanggal</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $penggajian->tanggal }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Kode Karyawan</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $penggajian->kode_karyawan }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Bagian</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{$penggajian->karyawan->bagian->nama_bagian}}
                    </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Nama Karyawan</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $penggajian->karyawan->nama_karyawan }}
                </p>
                </div>

                <div></div>

                
                
            </div>
            <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-2 py-3 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Gaji Pokok:</span>
                    <span>{{ 'Rp ' . number_format($penggajian->gaji_pokok, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Tunj.Transport:</span>
                    <span>{{ 'Rp ' . number_format($penggajian->tunj_transport, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Tunj.Makan:</span>
                    <span>{{ 'Rp ' . number_format($penggajian->tunj_makan, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Tunj.BPJS Kesehatan:</span>
                    <span>{{ 'Rp ' . number_format($bpjs_kesehatan, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Tunj.BPJS JKK:</span>
                    <span>{{ 'Rp ' . number_format($bpjs_jkk, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Tunj.BPJS JKM:</span>
                    <span>{{ 'Rp ' . number_format($bpjs_jkm, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Total Lembur:</span>
                    <span>{{ 'Rp ' . number_format($penggajian->total_lembur, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Total Bonus:</span>
                    <span>{{ 'Rp ' . number_format($penggajian->total_bonus, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-medium text-navy-700 dark:text-white border-t-2">
                    <span>Penghasilan Bruto =</span>
                    <span>{{ 'Rp ' . number_format($bruto, 0, ',', '.') }}</span>
                </div>
                <p class="italic text-xs">Dikurangi:</p>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Biaya Jabatan:</span>
                    <span>{{ 'Rp ' . number_format($biaya_jabatan, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Iuran BPJS Jaminan Hari Tua (JHT):</span>
                    <span>{{ 'Rp ' . number_format($bpjs_jht, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Iuran BPJS Jaminan Pensiunan (JP):</span>
                    <span>{{ 'Rp ' . number_format($bpjs_jp, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-medium text-navy-700 dark:text-white border-t-2">
                    <span>Penghasilan Neto =</span>
                    <span>{{ 'Rp ' . number_format($neto, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Penghasilan Neto Setahun=</span>
                    <span>{{ 'Rp ' . number_format($neto * 12, 0, ',', '.') }}</span>
                </div>
                <p class="italic text-xs">Dikurangi:</p>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Penghasilan Tidak Kena Pajak (PTKP):</span>
                    <span>{{ 'Rp ' . number_format($penggajian->ptkp, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-medium text-navy-700 dark:text-white border-t-2">
                    <span>Penghasilan Kena Pajak (PKP)=</span>
                    <span>{{ 'Rp ' . number_format($pkp, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>PPh 21 Setahun:</span>
                    <span>{{ 'Rp ' . number_format($pph21, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-medium text-navy-700 dark:text-white">
                    <span>PPh 21 Sebulan:</span>
                    <span>{{ 'Rp ' . number_format($pph21 / 12, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-navy-700 dark:text-white">
                    <span>Total Pinjaman:</span>
                    <span>-{{ 'Rp ' . number_format($penggajian->total_pinjaman, 0, ',', '.') }}</span>
                </div>
                <div class="flex border-t-2 justify-between text-base font-medium text-navy-700 dark:text-white">
                    <span>Gaji Bersih =</span>
                    <span>{{ 'Rp ' . number_format($gaji_bersih, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>  
    </div>
</x-layout>