<x-layout>
    <x-slot:title>{{ $title = 'Karyawan'; }}</x-slot:title>

    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3">
            <div class="mt-2 mb-8 w-full">
                <a href="{{ route('karyawan.index') }}" class="font-medium text-blue-600 hover:underline">Kembali</a>
                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-white text-center">
                    Informasi Lengkap
                </h4>
            </div> 
            <div class="grid grid-cols-2 gap-4 px-2 w-full">
                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Kode Karyawan</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->kode_karyawan }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">NIK</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->nik }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Nama Lengkap</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->nama_karyawan }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Bagian</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->bagian->nama_bagian }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Jenis Kelamin</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->kelamin }}
                </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Alamat</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->alamat }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">No HP</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $karyawan->no_hp }}
                </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Tempat Lahir</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $karyawan->tempat_lahir }}
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Tanggal Lahir</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $karyawan->tgl_lahir->format('d-m-Y') }}
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Agama</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $karyawan->agama }}
                    </p>
                </div>
                
                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $karyawan->status }}
                    </p>
                </div>
                
                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Tanggal Masuk</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        {{ $karyawan->tgl_masuk->format('d-m-Y') }}
                    </p>
                </div>
            </div>
        </div>  
    </div>
</x-layout>