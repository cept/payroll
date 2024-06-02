<x-layout>
    <x-slot:title>{{ $title = 'Bagian'; }}</x-slot:title>

    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
            <div class="mt-2 mb-8 w-full">
                <a href="{{ route('bagian.index') }}" class="font-medium text-blue-600 hover:underline">Kembali</a>
                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-white text-center">
                    Informasi Lengkap
                </h4>
            </div> 
            <div class="grid grid-cols-2 gap-4 px-2 w-full">
                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Kode Bagian</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $bagian->kode_bagian }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Nama Bagian</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $bagian->nama_bagian }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Gaji Pokok</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ 'Rp ' . number_format($bagian->gaji_pokok, 0, ',', '.') }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Uang Transport</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ 'Rp ' . number_format($bagian->uang_transport, 0, ',', '.') }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Uang Makan</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ 'Rp ' . number_format($bagian->uang_makan, 0, ',', '.') }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Uang Lembur</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ 'Rp ' . number_format($bagian->uang_lembur, 0, ',', '.') }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">BPJS Kesehatan</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $bagian->bpjs_kesehatan }}%
                </p>
                </div>
                
                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">BPJS Jaminan Kecelakaan Kerja (JKK)</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $bagian->bpjs_jkk }}%
                </p>
                </div>
                
                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">BPJS Jaminan Kematian (JKM)</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $bagian->bpjs_jkm }}%
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">BPJS Jaminan Hari Tua (JHT)</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $bagian->bpjs_jht }}%
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">BPJS Jaminan Pensiunan (JP)</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $bagian->bpjs_jp }}%
                    </p>
                </div>

            </div>
        </div>  
    </div>
</x-layout>