<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Aduan - Admin SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white p-4 flex justify-between">
        <h1 class="text-xl font-semibold">Dashboard Admin - SIPADU</h1>
        <a href="/logout/admin" class="hover:underline">Logout</a>
    </nav>

    <!-- Content -->
    <main class="p-8">
        <h2 class="text-2xl mb-6 font-bold">Daftar Aduan Mahasiswa</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-blue-100">
                <tr>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Mahasiswa</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Nomor Tiket</th>
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
                        <td class="border p-2">{{ $a->nomor_tiket }}</td>
                        <td class="border p-2">
                            @if($a->status === 'Menunggu')
                                <form action="{{ route('admin.aduan.assign', $a->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <select name="id_pic" class="border rounded p-1 w-full mb-1" required>
                                        <option value="">Pilih PIC</option>
                                        @foreach($picUnits as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_unit }} - {{ $p->nama_pic }}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="catatan" placeholder="Catatan (opsional)" class="border rounded p-1 w-full text-sm mb-1"></textarea>
                                    <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-sm hover:bg-blue-700 w-full">
                                        Tugaskan ke PIC
                                    </button>
                                </form>
                            @elseif($a->status === 'Diproses')
                                <form action="{{ route('admin.aduan.done', $a->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 w-full">
                                        Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 font-semibold">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
