@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Detail Aduan Publik')

@section('content')
<div class="container my-3">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white" style="padding-top: 1cm; padding-bottom: 1cm;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-10">{{ $aduan->judul }}</h4>
                    <small class="text-white-75">Nomor Tiket: <strong>{{ $aduan->nomor_tiket }}</strong></small>
                </div>
                <div class="text-end">
                    @if($aduan->status === 'Menunggu')
                        <span class="badge bg-secondary">Menunggu</span>
                    @elseif($aduan->status === 'Diproses' || $aduan->status === 'Sedang Dikerjakan')
                        <span class="badge bg-warning text-dark">Sedang Dikerjakan</span>
                    @elseif($aduan->status === 'Ditolak')
                        <span class="badge bg-danger text-white">Ditolak</span>
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
                    <p class="mb-0"><strong>Kategori:</strong> {{ $aduan->kategori }}</p><br>
                    <h6 class="fw-semibold">Deskripsi Aduan</h6>
                    <div class="p-3 bg-light border rounded">{{ $aduan->deskripsi }}</div><br>
                    <div class="p-3 bg-white border rounded">
                        @if($aduan->status_validasi !== null)
                            <div class="mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    @if($aduan->status_validasi === 'Valid')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill me-1"></i>Validasi: Valid
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle-fill me-1"></i>Validasi: Tidak Valid
                                        </span>
                                    @endif
                                </div>
                                <div class="p-3 bg-light border rounded">
                                    <strong>Catatan Admin</strong>
                                    <p class="mb-0 mt-2">{{ $aduan->catatan_admin }}</p>
                                </div>
                            </div>
                        @endif
</div><br>
                        <div class="p-3 bg-white border rounded">
                    <h6 class="fw-semibold">Catatan PIC Unit</h6>
                    
                        @if($catatanPic->isEmpty())
                            <div class="text-muted small">
                                @if($aduan->status_validasi === null)
                                    Menunggu validasi admin...
                                @else
                                    Belum ada catatan dari PIC.
                                @endif
                            </div>
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

                    <!-- Lampiran Foto - Conditional Display -->
                    @if($userType !== 'public')
                        @php
                            $fotoBuktiArray = is_string($aduan->foto_bukti) ? json_decode($aduan->foto_bukti, true) : ($aduan->foto_bukti ?? []);
                            // Fallback untuk data lama
                            if (empty($fotoBuktiArray) && isset($aduan->foto_url)) {
                                $fotoBuktiArray = [$aduan->foto_url];
                            }
                        @endphp
                        
                        <!-- Mahasiswa Owner & Admin: Lihat KTM + Bukti -->
                        @if($userType === 'mahasiswa_owner' || $userType === 'admin')
                            @if($aduan->foto_ktm || !empty($fotoBuktiArray))
                                <div class="mb-3">
                                    <br><h6 class="fw-semibold">Lampiran Foto</h6>
                                    <div class="row g-3">
                                        <!-- Foto KTM -->
                                        @if($aduan->foto_ktm)
                                            <div class="col-md-6">
                                                <div class="card border shadow-sm">
                                                    <div class="card-body p-0 position-relative">
                                                        <img src="{{ $aduan->foto_ktm }}" alt="Foto KTM" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover;">
                                                        <div class="position-absolute top-2 end-2" style="background: white; border-radius: 50%; padding: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                            <x-photo-viewer 
                                                                :fotoUrl="$aduan->foto_ktm" 
                                                                label="Foto KTM" />
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-light">
                                                        <small class="text-muted">Foto KTM</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Foto Bukti (Multiple/Gallery) -->
                                        @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                            <div class="col-md-6">
                                                <div class="card border shadow-sm">
                                                    <div class="card-body p-0 position-relative">
                                                        <img src="{{ $fotoBuktiArray[0] }}" alt="Foto Bukti" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover;">
                                                        @if(count($fotoBuktiArray) > 1)
                                                            <span class="position-absolute bottom-2 end-2 badge bg-dark" style="z-index: 10;">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                        @endif
                                                        <div class="position-absolute top-2 end-2" style="background: white; border-radius: 50%; padding: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                            <x-photo-gallery 
                                                                :fotoBuktiArray="$fotoBuktiArray" 
                                                                label="Foto Bukti Aduan" />
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-light">
                                                        <small class="text-muted">Foto Bukti Aduan ({{ count($fotoBuktiArray) }} foto)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        
                        <!-- PIC: Lihat Bukti Only, KTM Disabled -->
                        @elseif($userType === 'pic')
                            @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                <div class="mb-3">
                                    <h6 class="fw-semibold">Lampiran Foto</h6>
                                    <div class="row g-3">
                                        <!-- Foto Bukti (Multiple/Gallery) -->
                                        <div class="col-md-6">
                                            <div class="card border shadow-sm">
                                                <div class="card-body p-0 position-relative">
                                                    <img src="{{ $fotoBuktiArray[0] }}" alt="Foto Bukti" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover;">
                                                    @if(count($fotoBuktiArray) > 1)
                                                        <span class="position-absolute bottom-2 end-2 badge bg-dark" style="z-index: 10;">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                    @endif
                                                    <div class="position-absolute top-2 end-2" style="background: white; border-radius: 50%; padding: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                        <x-photo-gallery 
                                                            :fotoBuktiArray="$fotoBuktiArray" 
                                                            label="Foto Bukti Aduan" />
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-light">
                                                    <small class="text-muted">Foto Bukti Aduan ({{ count($fotoBuktiArray) }} foto)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @else
                        <!-- Public View: Tidak ada foto -->
                        <div class="alert alert-info mt-3" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Catatan Privasi:</strong> Foto dan identitas pelapor bersifat privasi. Hanya informasi dan status aduan yang ditampilkan di sini untuk verifikasi keabsahan aduan.
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
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('aduan.publik') }}" class="btn btn-outline-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</div>

<style>
.card-header { background: linear-gradient(90deg,#0d6efd,#0b5ed7); }
</style>
@endsection