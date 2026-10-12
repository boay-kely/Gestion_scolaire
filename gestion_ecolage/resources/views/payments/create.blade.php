@extends('layouts.app')

@section('page-title', 'Créer un Paiement')

@section('content')
<style>
    input[type="text"], input[type="number"], select, textarea {
        transition: all 0.3s ease;
    }
    input[type="text"]:hover, input[type="number"]:hover, select:hover, textarea:hover {
        border-color: #10b981 !important;
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
    .form-input, textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }
    .form-input.error, textarea.error {
        border-color: #dc2626;
    }
    .error-message {
        margin: 8px 0 0;
        font-size: 13px;
        color: #dc2626;
    }
</style>

<div style="max-width:700px;margin:0 auto">
    <!-- Header -->
    <div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:24px;color:#fff;margin-bottom:24px;box-shadow:0 4px 12px rgba(16,185,129,0.15)">
        <h2 style="margin:0;font-size:24px;font-weight:700">✨ Enregistrer un Paiement</h2>
        <p style="margin:8px 0 0;opacity:0.9">Remplissez le formulaire ci-dessous pour enregistrer un nouveau paiement</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('payments.store') }}" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px">
        @csrf

        <!-- Student Selection -->
        <div class="form-group">
            <label for="student_id" class="form-label">👤 Étudiant *</label>
            <select id="student_id" name="student_id"
                    class="form-input @error('student_id') error @enderror"
                    required>
                <option value="">-- Sélectionner un étudiant --</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                    {{ $student->full_name }} ({{ $student->registration_number }})
                </option>
                @endforeach
            </select>
            @error('student_id')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Fee Type & Academic Year -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="fee_type_id" class="form-label">💳 Type de Frais *</label>
                <select id="fee_type_id" name="fee_type_id"
                        class="form-input @error('fee_type_id') error @enderror"
                        required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($feeTypes as $feeType)
                    <option value="{{ $feeType->id }}" @selected(old('fee_type_id') == $feeType->id)>
                        {{ $feeType->name }}
                    </option>
                    @endforeach
                </select>
                @error('fee_type_id')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="academic_year_id" class="form-label">📅 Année Académique *</label>
                <select id="academic_year_id" name="academic_year_id"
                        class="form-input @error('academic_year_id') error @enderror"
                        required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" @selected(old('academic_year_id') == $year->id)>
                        {{ $year->label }}
                    </option>
                    @endforeach
                </select>
                @error('academic_year_id')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Amount & Payment Mode -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="amount" class="form-label">💰 Montant (€) *</label>
                <input type="number" id="amount" name="amount" 
                       value="{{ old('amount') }}"
                       class="form-input @error('amount') error @enderror"
                       placeholder="0.00"
                       step="0.01"
                       min="0"
                       required>
                @error('amount')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="payment_mode" class="form-label">🏦 Mode de Paiement *</label>
                <select id="payment_mode" name="payment_mode"
                        class="form-input @error('payment_mode') error @enderror"
                        required>
                    <option value="">-- Sélectionner --</option>
                    <option value="cash" @selected(old('payment_mode') == 'cash')>💵 Espèces</option>
                    <option value="bank_transfer" @selected(old('payment_mode') == 'bank_transfer')>🏦 Virement Bancaire</option>
                    <option value="check" @selected(old('payment_mode') == 'check')>📋 Chèque</option>
                    <option value="mobile_money" @selected(old('payment_mode') == 'mobile_money')>📱 Mobile Money</option>
                    <option value="card" @selected(old('payment_mode') == 'card')>💳 Carte Bancaire</option>
                </select>
                @error('payment_mode')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Notes -->
        <div class="form-group">
            <label for="notes" class="form-label">📝 Observations (optionnel)</label>
            <textarea id="notes" name="notes"
                      class="form-input @error('notes') error @enderror"
                      placeholder="Ajouter des notes ou commentaires...">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid #e5e7eb">
            <a href="{{ route('payments.index') }}" 
               style="padding:12px 24px;border:2px solid #e5e7eb;background:#fff;color:#374151;border-radius:8px;text-decoration:none;font-weight:600;transition:all 0.3s;cursor:pointer"
               onmouseover="this.style.background='#f3f4f6'"
               onmouseout="this.style.background='#fff'">
                ✗ Annuler
            </a>
            <button type="submit" 
                    style="padding:12px 24px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;border-radius:8px;font-weight:600;transition:all 0.3s;cursor:pointer"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 16px rgba(16,185,129,0.3)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                ✓ Enregistrer le Paiement
            </button>
        </div>
    </form>
</div>
@endsection
