<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tindak Lanjut Aduan - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-xl font-bold mb-4 text-yellow-700">Tindak Lanjut Aduan</h1>

        <p class="text-sm text-gray-600 mb-2">
            <strong>Judul:</strong> {{ $aduan->judul }} <br>
            <strong>Kategori:</strong> {{ $aduan->kategori }}
        </p>

        <form method="POST" action="{{ route('pic.tindaklanjut.store', $aduan->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Catatan Tindak Lanjut</label>
                <textarea name="catatan" class="border w-full p-2 rounded" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="status" class="border w-full p-2 rounded" required>
                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded hover:bg-yellow-700">
                Simpan Tindak Lanjut
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('pic.aduan.index') }}" class="text-yellow-700 hover:underline">← Kembali</a>
        </div>
    </div>

</body>
</html>
