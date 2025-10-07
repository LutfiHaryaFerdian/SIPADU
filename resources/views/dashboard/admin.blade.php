@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
@endphp
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

        <div class="grid grid-cols-3 gap-4 mb-8">
            @php
                $totalMenunggu = DB::table('aduan')->where('status', 'Menunggu')->count();
                $totalDiproses = DB::table('aduan')->where('status', 'Diproses')->count();
                $totalSelesai = DB::table('aduan')->where('status', 'Selesai')->count();
            @endphp

            <div class="bg-yellow-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-bold">Menunggu</h3>
                <p class="text-2xl font-bold text-yellow-700">{{ $totalMenunggu }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-bold">Diproses</h3>
                <p class="text-2xl font-bold text-blue-700">{{ $totalDiproses }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-bold">Selesai</h3>
                <p class="text-2xl font-bold text-green-700">{{ $totalSelesai }}</p>
            </div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Kelola Aduan
        </a>
    </main>
</body>
</html>
