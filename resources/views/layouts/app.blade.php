<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPADU')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            /* Add padding-top to account for fixed navbar */
            padding-top: 56px;
        }

        /* Animasi halus antar halaman */
        .fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar halus */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #adb5bd;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #6c757d;
        }

        footer {
            background: #f1f3f5;
        }
    </style>

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100 fade-in">

    <!-- 🔹 Navbar -->
    @yield('navbar')

    <!-- 🔹 Konten Halaman -->
    <!-- Remove margin-top from main, hero section will handle positioning -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <!-- 🔹 Footer -->
    <footer class="text-center text-muted py-3 border-top mt-auto">
        © {{ date('Y') }} SIPADU Universitas Lampung
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
