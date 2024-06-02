<x-layout>
    <x-slot:title>{{ $title = 'Management User' }}</x-slot:title>

    <div class="flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-16 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Buat Pengguna Baru</h1>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" placeholder="your@email.com" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" placeholder="Enter your password" required>
                    @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                    
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
                    <select id="role" name="is_admin" class="mt-1 p-2 w-full border rounded-md @error('is_admin') border-red-500 @enderror">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>Pengguna</option>
                        <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('is_admin')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Profil</label>
                    <input type="file" id="image" name="image" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" required>
                    @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                </div>
                
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
            </form>
        </div>
    </div>
</x-layout>