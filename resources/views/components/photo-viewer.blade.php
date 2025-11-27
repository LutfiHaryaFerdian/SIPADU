<!-- Komponen Icon Lihat Foto dengan Modal Preview -->
@props([
    'fotoUrl' => null,
    'label' => 'Lihat Foto',
    'modalId' => 'photoModal' . uniqid(),
    'disabled' => false
])

@if($fotoUrl && !$disabled)
    <!-- Icon Mata (Abu, Hover Hitam) -->
    <a href="#" 
       class="text-secondary text-decoration-none" 
       style="cursor: pointer; transition: color 0.2s;"
       onmouseover="this.style.color='#000';" 
       onmouseout="this.style.color='#6c757d';"
       onclick="event.preventDefault(); const modal = new bootstrap.Modal(document.getElementById('{{ $modalId }}')); modal.show();"
       title="{{ $label }}">
        <i class="bi bi-eye fs-5"></i>
    </a>

    <!-- Modal Preview Foto -->
    <div id="{{ $modalId }}" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $label }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ $fotoUrl }}" class="img-fluid" style="max-width: 100%; max-height: 600px; object-fit: contain;">
                </div>
                <div class="modal-footer">
                    <a href="{{ $fotoUrl }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@elseif($disabled)
    <!-- Icon Mata Disabled (Abu, tidak bisa diklik) -->
    <span class="text-secondary" title="Tidak dapat melihat foto ini" style="cursor: not-allowed;">
        <i class="bi bi-eye-slash fs-5"></i>
    </span>
@else
    <!-- Tidak ada foto -->
    <span class="text-muted">-</span>
@endif
