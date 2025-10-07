@extends('layouts.app')

@section('title', 'Mahasiswa - SIPADU')

@section('navbar')
<nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="text-lg font-semibold">SIPADU - Mahasiswa</h1>
    <div class="space-x-4">
        <a href="/mahasiswa/dashboard" class="hover:underline">Dashboard</a>
        <a href="/mahasiswa/aduan/create" class="hover:underline">Buat Aduan</a>
        <a href="/mahasiswa/aduan" class="hover:underline">Aduan Saya</a>
        <a href="/logout/mahasiswa" class="hover:underline">Logout</a>
    </div>
</nav>
@endsection
