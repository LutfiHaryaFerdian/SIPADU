@extends('layouts.app')

@section('title', 'Detail Aduan Publik')

@section('content')
<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">{{ $aduan->judul }}</h4>
                    <small class="text-white-50">Nomor Tiket: <strong>{{ $aduan->nomor_tiket }}</strong></small>
                </div>
                <div class="text-end">
                    @if($aduan->status === 'Menunggu')
                        <span class="badge bg-secondary">Menunggu</span>
                    @elseif($aduan->status === 'Diproses' || $aduan->status === 'Sedang Dikerjakan')
                        <span class="badge bg-warning text-dark">Sedang Dikerjakan</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                    <div class="small text-white-50 mt-1">{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
                    <hr>
                    <h6 class="fw-semibold">Deskripsi Aduan</h6>
                    <div class="p-3 bg-light border rounded mb-3">{{ $aduan->deskripsi }}</div>

                    @if($aduan->foto_url)
                        <div class="mb-3">
                            <h6 class="fw-semibold">Lampiran Foto</h6>
                            <img src="{{ $aduan->foto_url }}" alt="Lampiran" class="img-fluid rounded shadow-sm" />
                        </div>
                    @endif

                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white border rounded mb-3">
                        <h6 class="fw-semibold">Informasi Aduan</h6>
                        <p class="mb-1"><strong>Nomor Tiket:</strong><br>{{ $aduan->nomor_tiket }}</p>
                        <p class="mb-1"><strong>Tanggal Laporan:</strong><br>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i') }}</p>
                        <p class="mb-1"><strong>Status:</strong><br>
                            @if($aduan->status === 'Menunggu')
                                <span class="badge bg-secondary">Menunggu</span>
                            @elseif($aduan->status === 'Diproses' || $aduan->status === 'Sedang Dikerjakan')
                                <span class="badge bg-warning text-dark">Sedang Dikerjakan</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </p>
                    </div>

                    <div class="p-3 bg-white border rounded">
                        <h6 class="fw-semibold">Catatan PIC</h6>
                        @if($catatanPic->isEmpty())
                            <div class="text-muted small">Belum ada catatan dari PIC.</div>
                        @else
                            <ul class="list-unstyled small">
                                @foreach($catatanPic as $c)
                                    <li class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div><strong>{{ $c->pic_nama }}</strong></div>
                                            <div class="text-muted">{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y H:i') }}</div>
                                        </div>
                                        <div class="mt-1">
                                            <div class="badge {{ $c->status === 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }} mb-2">{{ $c->status }}</div>
                                            <div class="p-2 bg-light border rounded">{{ $c->catatan }}</div>
                                            @if($c->catatan_selesai)
                                                <div class="mt-2 p-2 bg-white border rounded">
                                                    <small class="text-muted">Catatan Penyelesaian:</small>
                                                    <div>{{ $c->catatan_selesai }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('aduan.publik') }}" class="btn btn-outline-secondary">Kembali ke Daftar Aduan Publik</a>
            </div>
        </div>
    </div>
</div>

<style>
.card-header { background: linear-gradient(90deg,#0d6efd,#0b5ed7); }
</style>
@endsection