@extends('layouts.app')

@section('title', 'Admin - SIPADU')

@section('navbar')
<nav class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="text-lg font-semibold">SIPADU - Admin</h1>
    <div class="space-x-4">
        <a href="/admin/dashboard" class="hover:underline">Dashboard</a>
        <a href="/admin/aduan" class="hover:underline">Aduan</a>
        <a href="/logout/admin" class="hover:underline">Logout</a>
    </div>
</nav>
@endsection
