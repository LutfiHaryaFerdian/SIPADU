@extends('layouts.app')

@section('title', 'PIC Unit - SIPADU')

@section('navbar')
<nav class="bg-yellow-600 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="text-lg font-semibold">SIPADU - PIC Unit</h1>
    <div class="space-x-4">
        <a href="/pic/dashboard" class="hover:underline">Dashboard</a>
        <a href="/pic/aduan" class="hover:underline">Aduan Ditugaskan</a>
        <a href="/logout/pic" class="hover:underline">Logout</a>
    </div>
</nav>
@endsection
