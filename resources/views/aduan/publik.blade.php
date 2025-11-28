@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Aduan Publik')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1"><i class="bi bi-globe2 me-2 text-primary"></i>Aduan Publik</h2>
            <p class="text-muted mb-0">Lihat semua aduan publik yang masuk ke sistem. Identitas pelapor disembunyikan demi privasi.</p>
        </div>
    </div>
    @if($aduan->isEmpty())
        <div class="alert alert-secondary text-center py-4 shadow-sm">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" alt="Empty" class="mb-2" style="height: 60px;">
            <p class="mb-0 text-muted"><i class="bi bi-info-circle me-1"></i> Belum ada aduan publik.</p>
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Nomor Tiket</th>
                                <th>Dibuat</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduan as $a)
                                <tr>
                                    <td>
                                        {{ $a->judul }}
                                    </td>
                                    <td>{{ $a->kategori }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($a->status == 'Menunggu') bg-secondary
                                            @elseif($a->status == 'Diproses') bg-warning text-dark
                                            @elseif($a->status == 'Selesai') bg-success
                                            @elseif($a->status == 'Ditolak') bg-danger text-white
                                            @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td><code>{{ $a->nomor_tiket }}</code></td>
                                    <td>{{ date('d M Y H:i', strtotime($a->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
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
.table th {
    white-space: nowrap;
}
.table td {
    vertical-align: middle;
}
</style>
@endsection
