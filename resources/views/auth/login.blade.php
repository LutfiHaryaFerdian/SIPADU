@extends('layout.base')

@section('title')
Login {{ ucfirst($role) }}
@endsection

@section('content')
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login/{{ $role }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="border w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="border w-full p-2 rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>

    <div class="mt-4 text-center text-sm text-gray-500">
        <p>
            <a href="/login/admin" class="text-blue-600 hover:underline">Admin</a> |
            <a href="/login/mahasiswa" class="text-blue-600 hover:underline">Mahasiswa</a> |
            <a href="/login/pic" class="text-blue-600 hover:underline">PIC</a>
        </p>
    </div>
@endsection
