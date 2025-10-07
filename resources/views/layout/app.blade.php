<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SIPADU - Sistem Pengaduan Mahasiswa' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="text-lg font-semibold">SIPADU UNILA</h1>
    <div>
        <a href="/logout" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</a>
    </div>
</nav>

<div class="container mx-auto p-6">
    @yield('content')
</div>

</body>
</html>
