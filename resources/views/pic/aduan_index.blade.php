<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PIC - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-yellow-600 text-white p-4 flex justify-between">
        <h1 class="text-xl font-semibold">Dashboard PIC - SIPADU</h1>
        <a href="/logout/pic" class="hover:underline">Logout</a>
    </nav>

    <!-- Content -->
    <main class="p-8">
        <h2 class="text-2xl mb-6 font-bold">Aduan yang Ditugaskan</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Mahasiswa</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Catatan Admin</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aduan as $a)
                    <tr class="border-t">
                        <td class="border p-2">{{ $a->judul }}</td>
                        <td class="border p-2">
                            {{ $a->nama_mahasiswa }}<br>
                            <span class="text-xs text-gray-500">({{ $a->npm }})</span>
                        </td>
                        <td class="border p-2">{{ $a->kategori }}</td>
                        <td class="border p-2">{{ $a->status }}</td>
                        <td class="border p-2">{{ $a->catatan_admin ?? '-' }}</td>
                        <td class="border p-2">
                            <a href="{{ route('pic.tindaklanjut.form', $a->id) }}" class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700">
                                Tindak Lanjut
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
