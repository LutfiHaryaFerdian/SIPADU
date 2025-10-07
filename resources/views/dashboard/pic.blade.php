@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PIC Unit - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-yellow-600 text-white p-4 flex justify-between">
        <h1 class="text-xl font-semibold">Dashboard PIC Unit</h1>
        <a href="/logout/pic" class="hover:underline">Logout</a>
    </nav>

    <main class="p-8">
        <h2 class="text-2xl mb-4">Selamat Datang, {{ session('pic')->nama_pic }}</h2>

        @php
            $pic = session('pic');
            $tugasAktif = DB::table('penugasan')
                ->join('aduan', 'penugasan.id_aduan', '=', 'aduan.id')
                ->where('penugasan.id_pic', $pic->id)
                ->where('aduan.status', '!=', 'Selesai')
                ->count();

            $tugasSelesai = DB::table('penugasan')
                ->join('aduan', 'penugasan.id_aduan', '=', 'aduan.id')
                ->where('penugasan.id_pic', $pic->id)
                ->where('aduan.status', 'Selesai')
                ->count();
        @endphp

        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-blue-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-bold">Tugas Aktif</h3>
                <p class="text-2xl font-bold text-blue-700">{{ $tugasAktif }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-bold">Tugas Selesai</h3>
                <p class="text-2xl font-bold text-green-700">{{ $tugasSelesai }}</p>
            </div>
        </div>

        <a href="{{ route('pic.dashboard') }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
            Lihat Semua Tugas
        </a>
    </main>
</body>
</html>
