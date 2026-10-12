@extends('layouts.app')

@section('page-title', $student->full_name)

@section('content')
<style>
    .info-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 24px;
        margin-bottom: 24px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1f2937;
    }
    .payment-item {
        padding: 12px;
        background: #f8fafc;
        border-left: 4px solid #10b981;
        border-radius: 6px;
        margin-bottom: 12px;
    }
    .discount-item {
        padding: 12px;
        background: #f0fdf4;
        border-left: 4px solid #10b981;
        border-radius: 6px;
        margin-bottom: 12px;
    }
    
    /* Student Gender Themes */
    /* Male (Boy) - Blue Theme */
    .student-profile.gender-M .student-photo-header {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }
    
    .student-profile.gender-M .student-photo {
        border-color: #fff;
    }
    
    /* Female (Girl) - Pink Theme */
    .student-profile.gender-F .student-photo-header {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
    }
    
    .student-profile.gender-F .student-photo {
        border-color: #fff;
    }
    
    .student-photo-header {
        height: 140px;
        border-radius: 12px;
        margin: -24px -24px 0 -24px;
        transition: all 0.3s ease;
    }
    
    .student-photo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .student-photo:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }
    .photo-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #fff;
        background: linear-gradient(135deg, #e5e7eb, #d1d5db);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    /* Modal Lightbox */
    #photoModal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        animation: fadeIn 0.3s ease;
    }
    #photoModal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        position: relative;
        background: #fff;
        border-radius: 12px;
        max-width: 90%;
        max-height: 90vh;
        overflow: auto;
    }
    .modal-image {
        width: 100%;
        height: auto;
        border-radius: 12px;
    }
    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 32px;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 50px;
        height: 50px;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-close:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: rotate(90deg);
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<!-- Photo Modal -->
<div id="photoModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closePhotoModal()">&times;</span>
        <img id="modalImage" class="modal-image" src="" alt="Photo agrandie">
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;margin-bottom:24px">
    <!-- Student Card -->
    <div class="student-profile gender-{{ $student->gender }}">
        <div class="info-card">
            <!-- Photo Header with Gender Theme -->
            <div class="student-photo-header"></div>
            <div style="display:flex;flex-direction:column;align-items:center;margin-top:-60px;margin-bottom:20px" id="photoContainer">
                @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->full_name }}"
                     class="student-photo" onclick="openPhotoModal(this.src)"
                     title="Cliquez pour agrandir"
                     loading="lazy"
                     onerror="handlePhotoError(this)">
                @else
                <div class="photo-placeholder">
                    👤
                </div>
                @endif
            </div>

            <h2 style="text-align:center;font-size:20px;font-weight:700;color:#1f2937;margin:0">{{ $student->full_name }}</h2>
            <p style="text-align:center;font-size:13px;color:#6b7280;margin:4px 0 0">📋 {{ $student->registration_number }}</p>

            <div style="margin-top:20px;padding-top:20px;border-top:1px solid #f3f4f6">
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Genre</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">
                        @if($student->gender === 'M') 🧑‍💼 Masculin @else 👩‍💼 Féminin @endif
                    </p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Date de Naissance</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">
                        @if(is_string($student->birth_date))
                            {{ $student->birth_date }}
                        @else
                            {{ $student->birth_date->format('d/m/Y') }}
                        @endif
                    </p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Lieu</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $student->birth_place }}</p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Classe</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $student->classroom->name }}</p>
                </div>
                <div>
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Niveau</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $student->classroom->level->name }}</p>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;padding-top:20px;border-top:1px solid #f3f4f6">
                <a href="{{ route('students.edit', $student) }}" 
                   style="flex:1;text-align:center;padding:10px 12px;background:#fef08a;color:#92400e;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;border:none;cursor:pointer;display:inline-block"
                   onmouseover="this.style.background='#fde047';this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.background='#fef08a';this.style.transform='translateY(0)'">
                    ✏️ Éditer
                </a>
                <form method="POST" action="{{ route('students.destroy', $student) }}" 
                      style="flex:1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="width:100%;padding:10px 12px;background:#fee2e2;color:#991b1b;border-radius:8px;font-weight:600;transition:all 0.3s;border:none;cursor:pointer"
                            onmouseover="this.style.background='#fecaca';this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.background='#fee2e2';this.style.transform='translateY(0)'">
                        🗑️ Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Details & Payments -->
    <div>
        <!-- Student Information -->
        <div class="info-card">
            <h3 style="margin:0 0 16px;font-size:16px;font-weight:700;color:#1f2937">📋 Informations Administratives</h3>
            <div class="info-row">
                <span class="info-label">Parent/Tuteur</span>
                <span class="info-value">{{ $student->parent?->full_name ?? 'Non assigné' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Créé par</span>
                <span class="info-value">{{ $student->createdBy->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date de Création</span>
                <span class="info-value">
                    @if(is_string($student->created_at))
                        {{ $student->created_at }}
                    @else
                        {{ $student->created_at->format('d/m/Y H:i') }}
                    @endif
                </span>
            </div>
            <div class="info-row" style="border:none">
                <span class="info-label">Dernière Modification</span>
                <span class="info-value">
                    @if(is_string($student->updated_at))
                        {{ $student->updated_at }}
                    @else
                        {{ $student->updated_at->format('d/m/Y H:i') }}
                    @endif
                </span>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="info-card">
            <h3 style="margin:0 0 16px;font-size:16px;font-weight:700;color:#1f2937">💳 Récapitulatif des Paiements</h3>
            @if($student->payments->count())
                <div>
                    @foreach($student->payments as $payment)
                    <div class="payment-item">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <div>
                                <p style="margin:0;font-weight:600;color:#1f2937;font-size:14px">{{ $payment->feeType->name }}</p>
                                <p style="margin:4px 0 0;color:#6b7280;font-size:12px">{{ $payment->payment_mode }}</p>
                            </div>
                            <div style="text-align:right">
                                <p style="margin:0;font-weight:700;color:#10b981;font-size:14px">{{ number_format($payment->amount, 0) }} FCFA</p>
                                <p style="margin:4px 0 0;color:#6b7280;font-size:11px">
                                    @if(is_string($payment->created_at))
                                        {{ $payment->created_at }}
                                    @else
                                        {{ $payment->created_at->format('d/m/Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="text-align:center;color:#9ca3af;padding:24px 0;margin:0">📭 Aucun paiement enregistré</p>
            @endif
        </div>

        <!-- Discounts -->
        @if($student->discounts->count())
        <div class="info-card">
            <h3 style="margin:0 0 16px;font-size:16px;font-weight:700;color:#1f2937">🎁 Remises Applicables</h3>
            @foreach($student->discounts as $discount)
            <div class="discount-item">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div>
                        <p style="margin:0;font-weight:600;color:#065f46;font-size:14px">{{ $discount->feeType->name }}</p>
                        <p style="margin:4px 0 0;color:#047857;font-size:12px">{{ $discount->reason }}</p>
                    </div>
                    <p style="margin:0;font-weight:700;color:#10b981;font-size:14px">-{{ number_format($discount->percentage, 2) }}%</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<div style="margin-top:24px">
    <a href="{{ route('students.index') }}" 
       style="display:inline-flex;align-items:center;gap:8px;color:#4f46e5;text-decoration:none;font-weight:600;transition:all 0.3s"
       onmouseover="this.style.color='#4338ca';this.style.transform='translateX(-4px)'"
       onmouseout="this.style.color='#4f46e5';this.style.transform='translateX(0)'">
        ← Retour à la liste
    </a>
</div>

<script>
function openPhotoModal(src) {
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = src;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
    const modal = document.getElementById('photoModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function showPhotoPlaceholder() {
    const container = document.getElementById('photoContainer');
    if (container) {
        container.innerHTML = '<div class="photo-placeholder">👤</div>';
    }
}

function handlePhotoError(img) {
    // Première tentative échouée avec asset(), essayer la route alternative
    if (!img.dataset.retry) {
        img.dataset.retry = 'true';
        // Construire l'URL de la route fallback
        const photoPath = img.getAttribute('alt') ? img.src.split('/storage/')[1] : null;
        if (photoPath) {
            img.src = '/storage/' + photoPath;
        } else {
            showPhotoPlaceholder();
        }
    } else {
        // Les deux tentatives ont échoué, afficher le placeholder
        showPhotoPlaceholder();
    }
}

// Fermer le modal en cliquant en dehors de l'image
document.getElementById('photoModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotoModal();
    }
});

// Fermer le modal avec la touche Échap
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePhotoModal();
    }
});
</script>
@endsection
