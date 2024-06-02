<x-layout>
    <x-slot:title>{{ $title = 'Laporan' }}</x-slot:title>

    <a href="{{ route('laporan.bagian') }}" class="block font-medium text-blue-600 hover:underline mb-3">>> Export Laporan Bagian</a>
    <a href="{{ route('laporan.karyawan') }}" class="block font-medium text-blue-600 hover:underline mb-3">>> Export Laporan Karyawan</a>
    <a href="{{ route('laporan.lembur') }}" class="block font-medium text-blue-600 hover:underline mb-3">>> Export Laporan Lembur</a>
    <a href="{{ route('laporan.pinjaman') }}" class="block font-medium text-blue-600 hover:underline mb-3">>> Export Laporan Pinjaman</a>

    <div x-data="{ open: false }">
        <a @click.prevent="open = true" href="#" class="block font-medium text-blue-600 hover:underline mb-3">>> Export Laporan Penggajian</a>

        <!-- Modal -->
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="open = false" class="bg-white rounded-lg p-8 w-1/2">
                <h2 class="text-xl font-bold mb-4">Filter Tanggal</h2>
                <form method="GET" action="{{ route('laporan.penggajian') }}">
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="mt-1 p-2 w-full border rounded-md @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}">
                        @error('start_date')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="mt-1 p-2 w-full border rounded-md @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}">
                        @error('end_date')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" @click="open = false" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Download PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
