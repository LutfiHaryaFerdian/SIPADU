<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPADU')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Animasi halus untuk transisi halaman */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar yang halus dan minimal */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #a0aec0;
        }
    </style>

    @stack('styles') <!-- untuk CSS tambahan per halaman -->
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col fade-in">

    <!-- Bagian Navbar atau Header -->
    @yield('navbar')

    <!-- Konten Halaman -->
    <main class="flex-1 p-6 md:p-10">
        @yield('content')
    </main>

    <!-- Footer Global -->
    <footer class="bg-gray-200 text-center text-sm text-gray-600 py-3 mt-auto">
        © {{ date('Y') }} SIPADU Universitas Lampung
    </footer>

    @stack('scripts') <!-- untuk JS tambahan per halaman -->
</body>
</html>
