@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
@endphp
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
        <p class="text-gray-600 mb-6">Gunakan menu di bawah untuk mengirim atau melihat status aduan Anda.</p>

        <div class="flex gap-4 mb-6">
            <a href="/mahasiswa/aduan/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Buat Aduan Baru
            </a>
            <a href="/mahasiswa/aduan" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                📋 Lihat Semua Aduan
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-3">Aduan Terbaru</h3>

            @php
                $aduanTerbaru = DB::table('aduan')
                    ->where('id_mahasiswa', session('mahasiswa')->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            @endphp

            @if($aduanTerbaru->isEmpty())
                <p class="text-gray-500">Belum ada aduan.</p>
            @else
                <table class="w-full border text-sm">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="border p-2">Judul</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aduanTerbaru as $a)
                            <tr class="border-t">
                                <td class="border p-2">{{ $a->judul }}</td>
                                <td class="border p-2">{{ $a->kategori }}</td>
                                <td class="border p-2">{{ $a->status }}</td>
                                <td class="border p-2">{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</body>
</html>
