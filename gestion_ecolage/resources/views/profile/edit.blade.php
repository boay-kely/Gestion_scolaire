@extends('layouts.app')

@section('title', 'Paramètres du Profil')
@section('page-title', '⚙️ Paramètres du Profil')
@section('page-subtitle', 'Gérez vos informations personnelles et de sécurité')

@section('content')
<div style="max-width:800px;margin:0 auto">
    <div class="info-card" style="padding:32px">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Section -->
            <div style="margin-bottom:32px;padding-bottom:32px;border-bottom:1px solid #f3f4f6">
                <h2 style="font-size:18px;font-weight:700;margin:0 0 24px;color:#1f2937">👤 Informations Personnelles</h2>

                <!-- Photo Section -->
                <div style="margin-bottom:24px;text-align:center;padding:24px;background:#f9fafb;border-radius:12px;border:2px dashed #e5e7eb">
                    <div style="margin-bottom:16px">
                        @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                             style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                        @else
                        <div style="width:120px;height:120px;margin:0 auto;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-size:48px;font-weight:700">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        @endif
                    </div>
                    <label for="photo" style="display:inline-block;padding:10px 24px;background:#4f46e5;color:white;border-radius:8px;cursor:pointer;font-weight:600;transition:all 0.3s ease;margin-bottom:8px">
                        📸 Changer la Photo
                    </label>
                    <input type="file" id="photo" name="photo" 
                           accept="image/*"
                           style="display:none"
                           onchange="previewPhoto(this)">
                    @error('photo')
                    <p class="error-message" style="display:block;margin-top:12px">⚠️ {{ $message }}</p>
                    @enderror
                    <p style="font-size:12px;color:#6b7280;margin:12px 0 0">JPG, PNG, GIF jusqu'à 2MB</p>
                </div>

                <!-- Name -->
                <div class="form-group" style="margin-bottom:24px">
                    <label for="name" class="form-label">Nom Complet *</label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $user->name) }}"
                           class="form-input @error('name') error @enderror"
                           placeholder="Entrez votre nom complet"
                           required>
                    @error('name')
                    <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group" style="margin-bottom:24px">
                    <label for="email" class="form-label">📧 Adresse Email *</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="form-input @error('email') error @enderror"
                           placeholder="Entrez votre adresse email"
                           required>
                    @error('email')
                    <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Security Section -->
            <div style="margin-bottom:32px;padding-bottom:32px;border-bottom:1px solid #f3f4f6">
                <h2 style="font-size:18px;font-weight:700;margin:0 0 24px;color:#1f2937">🔒 Sécurité</h2>

                <!-- Current Password -->
                <div class="form-group" style="margin-bottom:24px">
                    <label for="current_password" class="form-label">Mot de Passe Actuel</label>
                    <input type="password" id="current_password" name="current_password" 
                           class="form-input @error('current_password') error @enderror"
                           placeholder="Laissez vide pour ne pas changer le mot de passe">
                    <p style="font-size:12px;color:#6b7280;margin-top:8px">⚠️ Requis si vous modifiez votre mot de passe</p>
                    @error('current_password')
                    <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group" style="margin-bottom:24px">
                    <label for="password" class="form-label">🔐 Nouveau Mot de Passe</label>
                    <input type="password" id="password" name="password" 
                           class="form-input @error('password') error @enderror"
                           placeholder="Minimum 8 caractères">
                    <p style="font-size:12px;color:#6b7280;margin-top:8px">💡 Laissez vide pour garder votre mot de passe actuel</p>
                    @error('password')
                    <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group" style="margin-bottom:24px">
                    <label for="password_confirmation" class="form-label">🔐 Confirmer le Nouveau Mot de Passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="form-input"
                           placeholder="Confirmez votre nouveau mot de passe">
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display:flex;gap:12px;justify-content:flex-end">
                <a href="{{ route('dashboard') }}" class="btn" style="background:#f3f4f6;color:#1f2937;border:none">
                    Annuler
                </a>
                <button type="submit" class="btn" style="background:#4f46e5;color:white;border:none;cursor:pointer">
                    ✅ Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>

    <!-- User Info Card -->
    <div class="info-card" style="margin-top:24px;padding:24px;background:#f0f4ff;border-left:4px solid #4f46e5">
        <h3 style="margin:0 0 12px;color:#4f46e5;font-weight:700">ℹ️ Informations de Compte</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;font-size:13px">
            <div>
                <p style="margin:0;color:#6b7280;font-weight:600">Rôle:</p>
                <p style="margin:4px 0 0;color:#1f2937">{{ $user->role?->name ?? 'Administrateur' }}</p>
            </div>
            <div>
                <p style="margin:0;color:#6b7280;font-weight:600">Compte créé:</p>
                <p style="margin:4px 0 0;color:#1f2937">{{ $user->created_at->format('d/m/Y') }}</p>
            </div>
            <div>
                <p style="margin:0;color:#6b7280;font-weight:600">Dernière modification:</p>
                <p style="margin:4px 0 0;color:#1f2937">{{ $user->updated_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-input:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-input.error {
    border-color: #ef4444;
    background: #fef2f2;
}

.error-message {
    color: #ef4444;
    font-size: 12px;
    margin-top: 6px;
    margin-bottom: 0;
}

.btn {
    padding: 10px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
</style>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Find the photo container and update it
            const photoContainer = document.querySelector('[style*="margin-bottom:16px"]');
            if (photoContainer) {
                photoContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Preview"
                         style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                `;
            }
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
