@extends('layouts.app')

@section('title', 'Ajouter un Parent - Gestion d\'Écolage')
@section('page-title', 'Ajouter un Parent')

@section('content')
<style>
    input[type="text"], input[type="email"], input[type="number"], select, textarea {
        transition: all 0.3s ease;
    }
    input[type="text"]:hover, input[type="email"]:hover, input[type="number"]:hover, select:hover, textarea:hover {
        border-color: #ec4899 !important;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }
    .form-input.error {
        border-color: #dc2626;
    }
    .error-message {
        margin: 8px 0 0;
        font-size: 13px;
        color: #dc2626;
    }
    .alert-error {
        background: #fee2e2;
        border: 2px solid #dc2626;
        color: #991b1b;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }
    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }
    .alert-error li {
        margin: 4px 0;
    }
</style>

<div style="max-width:700px;margin:0 auto">
    <!-- Header -->
    <div style="background:linear-gradient(135deg,#ec4899,#be185d);border-radius:12px;padding:24px;color:#fff;margin-bottom:24px;box-shadow:0 4px 12px rgba(236,72,153,0.15)">
        <h2 style="margin:0;font-size:24px;font-weight:700">✨ Ajouter un Nouveau Parent</h2>
        <p style="margin:8px 0 0;opacity:0.9">Remplissez le formulaire ci-dessous pour ajouter un parent/tuteur</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('parents.store') }}" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px">
        @csrf

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- First & Last Name -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="first_name" class="form-label">👤 Prénom *</label>
                <input type="text" id="first_name" name="first_name" 
                       value="{{ old('first_name') }}"
                       class="form-input @error('first_name') error @enderror"
                       placeholder="Jean"
                       required>
                @error('first_name')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="last_name" class="form-label">👤 Nom de Famille *</label>
                <input type="text" id="last_name" name="last_name" 
                       value="{{ old('last_name') }}"
                       class="form-input @error('last_name') error @enderror"
                       placeholder="Dupont"
                       required>
                @error('last_name')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">✉️ Adresse E-mail *</label>
            <input type="email" id="email" name="email" 
                   value="{{ old('email') }}"
                   class="form-input @error('email') error @enderror"
                   placeholder="parent@example.com"
                   required>
            @error('email')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Phones -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="phone" class="form-label">📱 Téléphone Principal *</label>
                <input type="text" id="phone" name="phone" 
                       value="{{ old('phone') }}"
                       class="form-input @error('phone') error @enderror"
                       placeholder="+1 234 567 8900"
                       required>
                @error('phone')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="phone_secondary" class="form-label">📱 Téléphone Secondaire</label>
                <input type="text" id="phone_secondary" name="phone_secondary" 
                       value="{{ old('phone_secondary') }}"
                       class="form-input"
                       placeholder="+1 234 567 8901">
            </div>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address" class="form-label">📍 Adresse</label>
            <textarea id="address" name="address" class="form-input" placeholder="123 Rue de l'École, Ville, Code Postal" rows="3">{{ old('address') }}</textarea>
        </div>

        <!-- Occupation & Relationship -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="occupation" class="form-label">💼 Profession/Occupation</label>
                <input type="text" id="occupation" name="occupation" 
                       value="{{ old('occupation') }}"
                       class="form-input"
                       placeholder="Ingénieur">
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="relationship" class="form-label">👨‍👩‍👧 Lien de Parenté *</label>
                <select id="relationship" name="relationship" class="form-input" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Père" @selected(old('relationship') === 'Père')>Père</option>
                    <option value="Mère" @selected(old('relationship') === 'Mère')>Mère</option>
                    <option value="Tuteur" @selected(old('relationship') === 'Tuteur')>Tuteur</option>
                    <option value="Grand-parent" @selected(old('relationship') === 'Grand-parent')>Grand-parent</option>
                    <option value="Autre" @selected(old('relationship') === 'Autre')>Autre</option>
                </select>
            </div>
        </div>

        <!-- Annual Income -->
        <div class="form-group">
            <label for="annual_income" class="form-label">💰 Revenu Annuel Estimé</label>
            <input type="number" id="annual_income" name="annual_income" 
                   value="{{ old('annual_income') }}"
                   class="form-input"
                   placeholder="50000.00"
                   step="0.01">
        </div>

        <!-- Notes -->
        <div class="form-group">
            <label for="notes" class="form-label">📝 Notes/Observations</label>
            <textarea id="notes" name="notes" class="form-input" placeholder="Informations supplémentaires..." rows="4">{{ old('notes') }}</textarea>
        </div>

        <!-- Buttons -->
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid #e5e7eb">
            <a href="{{ route('parents.index') }}" 
               style="padding:12px 24px;border:2px solid #e5e7eb;background:#fff;color:#374151;border-radius:8px;text-decoration:none;font-weight:600;transition:all 0.3s;cursor:pointer"
               onmouseover="this.style.background='#f3f4f6'"
               onmouseout="this.style.background='#fff'">
                ✗ Annuler
            </a>
            <button type="submit" 
                    style="padding:12px 24px;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;border:none;border-radius:8px;font-weight:600;transition:all 0.3s;cursor:pointer"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 16px rgba(236,72,153,0.3)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                ✓ Créer le Parent
            </button>
        </div>
    </form>
</div>
@endsection
