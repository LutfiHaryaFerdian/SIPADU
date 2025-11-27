@extends('layouts.pic')

@section('title', 'SIPADU - Dashboard PIC Unit')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <img src="https://cdn-icons-png.flaticon.com/512/2920/2920252.png" 
             alt="PIC Illustration" class="img-fluid mb-3" style="max-height: 120px;">
        <h1 class="fw-bold text-warning mb-1">
            <i class="bi bi-building-gear me-2"></i>Dashboard PIC Unit
        </h1>
        <p class="text-muted mb-0">Pantau dan kelola aduan yang ditugaskan ke unit Anda.</p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-dark bg-warning bg-opacity-75 shadow border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-briefcase-fill display-5 text-dark me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Total Tugas</h6>
                        <h3 class="fw-bold mb-0">{{ $totalTugas }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-light shadow border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-tools display-5 text-warning me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Sedang Dikerjakan</h6>
                        <h3 class="fw-bold mb-0">{{ $aduanProses }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-check-circle-fill display-5 me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Selesai</h6>
                        <h3 class="fw-bold mb-0">{{ $aduanSelesai }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aduan Terbaru -->
    <div class="card shadow border-0">
        <div class="card-header bg-warning text-dark fw-semibold">
            <i class="bi bi-list-check me-2"></i>Aduan Terbaru yang Ditugaskan
        </div>
        <div class="card-body p-0">
            @php
                use Illuminate\Support\Facades\DB;
                $id_pic = session('pic')->id;
            @endphp

            @if($aduanTerbaru->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-info-circle me-2"></i>Belum ada aduan yang ditugaskan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-warning">
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduanTerbaru as $a)
                            @php
                                // Get status dari tindak_lanjut terbaru
                                $tindakLanjutTerbaru = DB::table('tindak_lanjut')
                                    ->where('id_aduan', $a->id)
                                    ->where('id_pic', $id_pic)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                                
                                $statusDisplay = $a->status;
                                if ($tindakLanjutTerbaru) {
                                    $statusDisplay = $tindakLanjutTerbaru->status;
                                }
                            @endphp
                            <tr>
                                <td>
                                    {{ $a->judul }}
                                    <a href="{{ route('aduan.publik.detail', $a->id) }}" class="ms-2 text-primary" style="text-decoration: underline;">| Detail Aduan</a>
                                </td>
                                <td>{{ $a->kategori }}</td>
                                <td>
                                    @if($statusDisplay == 'Menunggu')
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-hourglass me-1"></i>Menunggu
                                        </span>
                                    @elseif($statusDisplay == 'Diproses' || $statusDisplay == 'Sedang Dikerjakan')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-gear-fill me-1"></i>Sedang Dikerjakan
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                        </span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
}
.table-warning th {
    background-color: #ffe082 !important;
}
</style>
@endsection
