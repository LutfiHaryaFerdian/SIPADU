<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-4 text-center">Login SIPADU</h1>
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="border w-full p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="border w-full p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</body>
</html>
