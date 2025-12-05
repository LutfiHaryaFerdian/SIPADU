@extends('layouts.admin')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="container my-5">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-people-fill text-primary me-2"></i>Daftar Mahasiswa
    </h2>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Pencarian --}}
            <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="mb-3 d-flex">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control me-2" placeholder="Cari nama atau email...">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NPM</th>
                            <th>Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($mahasiswa as $mhs)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td class="text-center">
                                <img src="{{ $mhs->foto_profile ?? 'https://via.placeholder.com/60' }}"
                                    alt="Foto Profil" class="rounded-circle" width="55" height="55">
                            </td>

                            <td>{{ $mhs->nama }}</td>
                            <td>{{ $mhs->email }}</td>
                            <td>{{ $mhs->npm }}</td>
                            <td>{{ $mhs->prodi }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.mahasiswa.detail', $mhs->id) }}" 
                                class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('admin.mahasiswa.delete', $mhs->id) }}" 
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    Tidak ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
