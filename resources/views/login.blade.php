<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">

    <!-- component -->
<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
	<div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-16 py-6 max-w-md">
		<h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome Back!</h1>
		@error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
		<form action="{{ route('login') }}" method="POST">
		@csrf
			<div class="mb-4">
				<label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
				<input type="email" id="email" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="your@email.com" required>
			</div>
			<div class="mb-4">
				<label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
				<input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your password" required>
				
			</div>
            
			<button onclick="alert("hello")" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
		</form>
	</div>
</div>

</body>
</html>