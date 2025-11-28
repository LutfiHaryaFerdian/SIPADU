<!-- Modal Gallery untuk Multiple Foto Bukti -->
@props([
    'fotoBuktiArray' => [],
    'label' => 'Foto Bukti Aduan',
    'modalId' => 'buktiGalleryModal' . uniqid(),
])

@php
    $carouselId = 'carousel' . uniqid();
    $openTabBtnId = 'openTabBtn' . uniqid();
@endphp

@if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
    <!-- Icon Mata untuk Foto Bukti (Multiple) -->
    <a href="#" 
       class="text-secondary text-decoration-none" 
       style="cursor: pointer; transition: color 0.2s;"
       onmouseover="this.style.color='#000';" 
       onmouseout="this.style.color='#6c757d';"
       onclick="event.preventDefault(); const modal = new bootstrap.Modal(document.getElementById('{{ $modalId }}')); modal.show();"
       title="Lihat {{ $label }}">
        <i class="bi bi-eye fs-5"></i>
    </a>

    <!-- Modal Gallery Foto Bukti -->
    <div id="{{ $modalId }}" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $label }} ({{ count($fotoBuktiArray) }} foto)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Carousel untuk Multiple Foto -->
                    <div id="{{ $carouselId }}" class="carousel slide" data-bs-interval="false" data-bs-keyboard="false">
                        <div class="carousel-inner">
                            @foreach($fotoBuktiArray as $index => $foto)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="text-center" style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
                                        <img src="{{ $foto }}" class="img-fluid" style="max-width: 100%; max-height: 500px; object-fit: contain; border-radius: 8px;">
                                        <div class="mt-3 text-muted small">
                                            <strong>Foto {{ $index + 1 }} dari {{ count($fotoBuktiArray) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Buttons (hanya tampil jika lebih dari 1 foto) -->
                        @if(count($fotoBuktiArray) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                    <!-- Thumbnail Navigation -->
                    @if(count($fotoBuktiArray) > 1)
                        <div class="mt-3 d-flex gap-2 overflow-x-auto pb-2" style="flex-wrap: wrap;">
                            @foreach($fotoBuktiArray as $index => $foto)
                                <button type="button" class="btn btn-sm p-0 border-2" 
                                    data-bs-target="#{{ $carouselId }}" 
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $foto }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <!-- Tombol Buka Tab Baru per Foto (Dynamic) -->
                    <a href="{{ $fotoBuktiArray[0] }}" target="_blank" id="{{ $openTabBtnId }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Foto di Tab Baru
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Update tombol "Buka di Tab Baru" saat carousel berubah
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('{{ $carouselId }}');
        const openTabBtn = document.getElementById('{{ $openTabBtnId }}');
        const fotos = @json($fotoBuktiArray);
        
        if (carousel && openTabBtn) {
            const carouselInstance = new bootstrap.Carousel(carousel, { 
                interval: false, 
                keyboard: false,
                wrap: true 
            });
            
            carousel.addEventListener('slide.bs.carousel', function(event) {
                if (fotos[event.to]) {
                    openTabBtn.href = fotos[event.to];
                }
            });
        }
    });
    </script>
@else
    <!-- Tidak ada foto -->
    <span class="text-muted">-</span>
@endif
