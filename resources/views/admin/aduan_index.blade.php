@extends('layouts.admin')

@section('title', 'SIPADU - Manajemen Aduan')

@section('content')
<div class="container my-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4727/4727424.png" 
             alt="Manajemen Aduan" 
             class="img-fluid mb-3" 
             style="max-height: 120px;">
        <h2 class="fw-bold text-danger">
            <i class="bi bi-chat-left-text me-2"></i>Manajemen Aduan Mahasiswa
        </h2>
        <p class="text-muted">Kelola dan distribusikan aduan mahasiswa kepada PIC Unit dengan mudah.</p>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Aduan --}}
    @if($aduan->isEmpty())
        <div class="alert alert-light border text-center py-4">
            <i class="bi bi-info-circle-fill text-danger me-2"></i>
            <span class="fw-semibold text-secondary">Belum ada aduan mahasiswa.</span>
        </div>
    @else
        <div class="card shadow border-0">
            <div class="card-header bg-danger text-white fw-semibold">
                <i class="bi bi-clipboard-data me-2"></i> Daftar Aduan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-danger">
                            <tr>
                                <th>Judul</th>
                                <th>Mahasiswa</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Nomor Tiket</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduan as $a)
                                <tr>
                                    <td class="fw-semibold">{{ $a->judul }}</td>
                                    <td>
                                        <strong>{{ $a->nama_mahasiswa }}</strong><br>
                                        <small class="text-muted">NPM: {{ $a->npm }}</small>
                                    </td>
                                    <td>{{ $a->kategori }}</td>
                                    <td>
                                        @if($a->status === 'Menunggu')
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-hourglass me-1"></i>Menunggu
                                            </span>
                                        @elseif($a->status === 'Diproses')
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-gear-fill me-1"></i>Diproses
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            <!-- Foto KTM -->
                                            @if($a->foto_ktm)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $a->foto_ktm }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 70px; height: 70px; object-fit: cover;">
                                                    <div class="position-absolute top-0 end-0" style="background: white; border-radius: 50%; padding: 2px; margin: -8px -8px 0 0;">
                                                        <x-photo-viewer 
                                                            :fotoUrl="$a->foto_ktm" 
                                                            label="Foto KTM" />
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif

                                            <!-- Foto Bukti (Multiple) -->
                                            @php
                                                $fotoBuktiArray = is_string($a->foto_bukti) ? json_decode($a->foto_bukti, true) : ($a->foto_bukti ?? []);
                                                // Fallback untuk data lama
                                                if (empty($fotoBuktiArray) && isset($a->foto_url)) {
                                                    $fotoBuktiArray = [$a->foto_url];
                                                }
                                            @endphp
                                            @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $fotoBuktiArray[0] }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 70px; height: 70px; object-fit: cover;">
                                                    @if(count($fotoBuktiArray) > 1)
                                                        <span class="position-absolute bottom-0 end-0 badge bg-dark rounded-circle" style="font-size: 0.7rem; padding: 2px 4px;">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                    @endif
                                                    <div class="position-absolute top-0 end-0" style="background: white; border-radius: 50%; padding: 2px; margin: -8px -8px 0 0;">
                                                        <x-photo-gallery 
                                                            :fotoBuktiArray="$fotoBuktiArray" 
                                                            label="Foto Bukti Aduan" />
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="font-monospace">{{ $a->nomor_tiket }}</td>
                                    <td class="text-center">
                                        @if($a->status === 'Menunggu')
                                            <form action="{{ route('admin.aduan.assign', $a->id) }}" method="POST" class="p-2 bg-light rounded shadow-sm">
                                                @csrf
                                                <div class="mb-2">
                                                    <select name="id_pic" class="form-select form-select-sm border-danger" required>
                                                        <option value="">Pilih PIC Unit</option>
                                                        @foreach($picUnits as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama_unit }} - {{ $p->nama_pic }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <textarea name="catatan" placeholder="Catatan (opsional)" class="form-control form-control-sm border-danger" rows="2"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                                    <i class="bi bi-send-fill me-1"></i> Tugaskan ke PIC
                                                </button>
                                            </form>
                                        @elseif($a->status === 'Diproses')
                                            <form action="{{ route('admin.aduan.done', $a->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-success w-100 shadow-sm">
                                                    <i class="bi bi-check2-circle me-1"></i> Tandai Selesai
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-success fw-semibold">
                                                <i class="bi bi-check-circle me-1"></i> Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.card:hover {
    transform: translateY(-3px);
    transition: all 0.3s ease-in-out;
    box-shadow: 0 8px 18px rgba(220, 53, 69, 0.2);
}
.table thead th {
    vertical-align: middle;
}
select:focus, textarea:focus {
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}
</style>
@endsection
