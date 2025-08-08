<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Admin</h2>
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-center text-red-800 rounded-lg bg-red-50">
                {{ session('error') }} </div>
        @endif

        <form action="{{ route('autenticate') }}" method="POST" class="space-y-4">
        @csrf
        <div class="">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="mt-1 py-4 px-2 block w-full rounded-lg border border-gray-300 shadow-sm ring-1 focus:ring-blue-200 focus:ring-opacity-50">
            @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}" required autofocus class="mt-1 py-4 px-2 block w-full rounded-lg border border-gray-300 shadow-sm ring-1 focus:ring-blue-200 focus:ring-opacity-50">
            @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="pt-2">
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Masuk</button>
        </div>
        </form>
    </div>
</body>

</html>
