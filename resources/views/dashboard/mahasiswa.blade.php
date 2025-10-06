<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-green-600 text-white p-4 flex justify-between">
        <h1 class="text-xl font-semibold">Dashboard Mahasiswa</h1>
        <a href="/logout/mahasiswa" class="hover:underline">Logout</a>
    </nav>

    <main class="p-8">
        <h2 class="text-2xl mb-4">Selamat Datang, {{ session('mahasiswa')->nama }}</h2>
        <p class="text-gray-600">Gunakan menu di bawah untuk mengirim atau melihat status aduan Anda.</p>

        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-2">Aduan Terbaru</h3>
            <p>Belum ada data (contoh placeholder).</p>
        </div>
    </main>
</body>
</html>
