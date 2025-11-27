@extends('layouts.pic')

@section('title', 'SIPADU - Lihat Tindak Lanjut Aduan')

@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png"
             alt="Tindak Lanjut" class="img-fluid mb-3" style="max-height: 110px;">
        <h2 class="fw-bold text-warning mb-1">
            <i class="bi bi-eye me-2"></i>Lihat Tindak Lanjut Aduan
        </h2>
        <p class="text-muted">Catatan tindak lanjut yang telah diselesaikan.</p>
    </div>

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 800px;">
        <div class="card-header bg-success text-white text-center fw-semibold">
            <i class="bi bi-check-circle-fill me-2"></i>Detail Penyelesaian Aduan
        </div>
        <div class="card-body p-4">
            {{-- Info Aduan --}}
            <div class="mb-4 border-start border-4 border-success ps-3">
                <p class="mb-1"><strong>Judul:</strong> {{ $aduan->judul }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-success">{{ $tindakLanjutTerbaru->status }}</span>
                </p>
            </div>

            {{-- Catatan Penyelesaian (Jika ada) --}}
            @if($tindakLanjutTerbaru->catatan_selesai)
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="fw-semibold mb-0"><i class="bi bi-check-circle text-success me-2"></i>Catatan Penyelesaian (Final)</h6>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <small class="text-muted d-block mb-2">⏱️ Catatan ini sudah final dan tidak bisa diubah lagi</small>
                    </div>
                    <div class="p-3 bg-light border-start border-4 border-success rounded">
                        {{ $tindakLanjutTerbaru->catatan_selesai }}
                    </div>
                </div>
            @else
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="fw-semibold mb-0"><i class="bi bi-check-circle text-success me-2"></i>Catatan Penyelesaian</h6>
                    </div>
                    <div class="p-3 bg-light border-start border-4 border-success rounded">
                        <em class="text-muted">Belum ada catatan penyelesaian.</em>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('pic.catatan.edit-selesai', $aduan->id) }}" class="btn btn-sm btn-success">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Catatan Penyelesaian
                        </a>
                    </div>
                </div>
            @endif

            {{-- Riwayat Tindak Lanjut --}}
            <div class="mb-4">
                <h6 class="fw-semibold mb-3"><i class="bi bi-clock-history text-info me-2"></i>Riwayat Tindak Lanjut</h6>
                <div class="timeline">
                    @foreach($riwayatTindakLanjut as $index => $tl)
                        <div class="timeline-item mb-4 pb-4 border-bottom" @if($loop->last) style="border-bottom: none;" @endif>
                            <div class="d-flex">
                                <div class="timeline-marker me-3">
                                    @if($tl->status === 'Sedang Dikerjakan')
                                        <span class="badge bg-warning text-dark" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.2rem;">
                                            <i class="bi bi-tools"></i>
                                        </span>
                                    @else
                                        <span class="badge bg-success" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.2rem;">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    @endif
                                </div>
                                <div class="timeline-content flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $tl->status === 'Sedang Dikerjakan' ? '🔧 Sedang Dikerjakan' : '✅ Selesai' }}
                                            </h6>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($tl->created_at)->format('d M Y H:i') }}
                                                @if($tl->updated_at !== $tl->created_at)
                                                    <br><em>Diperbarui: {{ \Carbon\Carbon::parse($tl->updated_at)->format('d M Y H:i') }}</em>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-light border-start border-4" style="border-color: {{ $tl->status === 'Sedang Dikerjakan' ? '#ffc107' : '#28a745' }}; border-radius: 4px;">
                                        <p class="mb-0 text-dark">{{ $tl->catatan }}</p>
                                        @if($tl->catatan_selesai)
                                            <hr class="my-2">
                                            <div class="mt-2 pt-2 border-top">
                                                <small class="text-muted d-block mb-1"><strong>Catatan Penyelesaian:</strong></small>
                                                <p class="mb-0 text-dark">{{ $tl->catatan_selesai }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('pic.aduan.index') }}" class="btn btn-outline-secondary shadow-sm">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 128, 0, 0.3);
}
.timeline {
    position: relative;
    padding: 0;
}
.timeline-item {
    display: flex;
    position: relative;
}
.timeline-marker {
    flex-shrink: 0;
}
.timeline-content {
    min-width: 0;
}
</style>
@endsection
