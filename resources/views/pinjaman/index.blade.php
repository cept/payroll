<x-layout>
    <x-slot:title>{{ $title = 'Pinjaman' }}</x-slot:title>
    
    <a href="{{ route('pinjaman.create') }}" class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
        Tambah Pinjaman
        </a>
    
        <div class="flex gap-4 mt-6 mb-3">
            <form action="{{ route('pinjaman.search') }}" method="post">
            @csrf
                <input class="h-10 min-w-[12rem] rounded-lg border-emerald-500 indent-4 text-emerald-900 shadow-lg focus:outline-none focus:ring focus:ring-emerald-600" type="search" name="search" placeholder="Search..." value="{{ request('search') }}"/>
                <button class="h-10 min-w-[6rem] rounded-lg bg-emerald-500 text-emerald-50 shadow-lg hover:bg-emerald-600 focus:outline-none focus:ring focus:ring-emerald-600">Search</button>
            </form>
        </div>
        
    
        <table class="table-fixed w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kode Karyawan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Besar Pinjaman
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status Lunas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{-- <span class="sr-only">Edit</span> --}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinjamans as $pinjaman)
                    
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    
                    <td scope="row" class="px-6 py-4">
                        {{ $pinjaman->tanggal }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pinjaman->kode_karyawan }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pinjaman->karyawan->nama_karyawan }}
                    </td>
                    <td class="px-6 py-4">
                        {{ 'Rp ' . number_format($pinjaman->besar_pinjaman, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pinjaman->keterangan }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pinjaman->status_lunas }}
                    </td>
                    <td class="px-6 py-4">
                        <form onsubmit="return confirm('Apakah anda yakin ?');" action="{{ route('pinjaman.destroy', $pinjaman->id) }}" method="post">
                            <a href="{{ route('pinjaman.edit', $pinjaman->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Edit</a>
                        @csrf
                        @method('DELETE')
                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        {{ $pinjamans->links() }}
    
        @if (session('success'))
            
            <!-- component alert -->
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:items-start sm:p-6">
            <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
    
            <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="p-4">
                  <div class="flex items-start">
                    <div class="flex-shrink-0">
                      <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                      <p class="text-sm font-medium text-gray-900">{{ session('success') }}</p>
                    </div>
                  </div>
                </div>
            </div>
            </div>
          </div>
            
        @endif
</x-layout>