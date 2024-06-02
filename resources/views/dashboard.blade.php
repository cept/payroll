<x-layout>
    <x-slot:title>{{ $title = 'Dashboard' }}</x-slot:title>
    
    <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-gray-800 p-8 rounded-lg">
          <div class="flex flex-row space-x-4 items-center">
              <div>
                  <p class="text-indigo-300 text-sm font-medium uppercase leading-4">Users</p>
                  <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                      <span>{{$jumlahUser}}</span>
                  </p>
              </div>
          </div>
      </div>
      <div class="bg-gray-800 p-8 rounded-lg">
          <div class="flex flex-row space-x-4 items-center">
              <div>
                  <p class="text-teal-300 text-sm font-medium uppercase leading-4">Karyawan</p>
                  <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                      <span>{{$jumlahKaryawan}}</span>
                  </p>
              </div>
          </div>
      </div>
      <div class="bg-gray-800 p-8 rounded-lg">
          <div class="flex flex-row space-x-4 items-center">
              <div>
                  <p class="text-blue-300 text-sm font-medium uppercase leading-4">Bagian / Divisi</p>
                  <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                      <span>{{$jumlahBagian}}</span>
                  </p>
              </div>
          </div>
      </div>
  </div>
</x-layout>