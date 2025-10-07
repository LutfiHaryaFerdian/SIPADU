<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login {{ ucfirst($role) }} - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #1e3a8a, #2563eb);
            min-height: 100vh;
        }

        .fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="flex justify-center items-center">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md fade-in">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">SIPADU Universitas Lampung</h1>
            <p class="text-gray-500">Login sebagai <span class="font-semibold text-blue-700">{{ ucfirst($role) }}</span></p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login/{{ $role }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                    class="border border-gray-300 w-full p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan email..." required>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                    class="border border-gray-300 w-full p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password..." required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Login sebagai:
                <a href="/login/admin" class="text-blue-600 hover:underline font-medium">Admin</a> |
                <a href="/login/mahasiswa" class="text-blue-600 hover:underline font-medium">Mahasiswa</a> |
                <a href="/login/pic" class="text-blue-600 hover:underline font-medium">PIC</a>
            </p>
        </div>

        <footer class="mt-8 text-center text-xs text-gray-400">
            © {{ date('Y') }} SIPADU Universitas Lampung
        </footer>
    </div>

</body>
</html>
