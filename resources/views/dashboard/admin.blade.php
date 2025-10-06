<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-700 text-white p-4 flex justify-between">
        <h1 class="text-xl font-semibold">Dashboard Admin</h1>
        <a href="/logout/admin" class="hover:underline">Logout</a>
    </nav>

    <main class="p-8">
        <h2 class="text-2xl mb-4">Selamat Datang, {{ session('admin')->nama }}</h2>
        <p class="text-gray-600">Anda dapat mengelola aduan mahasiswa di sini.</p>

        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-2">Statistik Pengaduan</h3>
            <p>Belum ada data (contoh placeholder).</p>
        </div>
    </main>
</body>
</html>
