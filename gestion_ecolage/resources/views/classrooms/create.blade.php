@extends('layouts.app')

@section('page-title', 'Créer une Classe')

@section('content')
<style>
    input[type="text"], input[type="number"], select {
        transition: all 0.3s ease;
    }
    input[type="text"]:hover, input[type="number"]:hover, select:hover {
        border-color: #4f46e5 !important;
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
</style>

<div style="max-width:700px;margin:0 auto">
    <!-- Header -->
    <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:12px;padding:24px;color:#fff;margin-bottom:24px;box-shadow:0 4px 12px rgba(79,70,229,0.15)">
        <h2 style="margin:0;font-size:24px;font-weight:700">✨ Créer une Nouvelle Classe</h2>
        <p style="margin:8px 0 0;opacity:0.9">Remplissez le formulaire ci-dessous pour créer une nouvelle classe</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('classrooms.store') }}" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px">
        @csrf

        <!-- Classroom Name -->
        <div class="form-group">
            <label for="name" class="form-label">🏫 Nom de la Classe *</label>
            <input type="text" id="name" name="name" 
                   value="{{ old('name') }}"
                   class="form-input @error('name') error @enderror"
                   placeholder="Ex: 6A, Terminale S, etc."
                   required>
            @error('name')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Level & Academic Year -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="level_name" class="form-label">📚 Niveau *</label>
                <input type="text" id="level_name" name="level_name" 
                       value="{{ old('level_name') }}"
                       class="form-input @error('level_name') error @enderror"
                       placeholder="Ex: 6ème, 5ème, Terminale, etc."
                       required>
                @error('level_name')
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

        <!-- Capacity -->
        <div class="form-group">
            <label for="capacity" class="form-label">👥 Capacité Maximale *</label>
            <input type="number" id="capacity" name="capacity" 
                   value="{{ old('capacity', 30) }}"
                   class="form-input @error('capacity') error @enderror"
                   min="1" max="100"
                   required>
            @error('capacity')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid #e5e7eb">
            <a href="{{ route('classrooms.index') }}" 
               style="padding:12px 24px;border:2px solid #e5e7eb;background:#fff;color:#374151;border-radius:8px;text-decoration:none;font-weight:600;transition:all 0.3s;cursor:pointer"
               onmouseover="this.style.background='#f3f4f6'"
               onmouseout="this.style.background='#fff'">
                ✗ Annuler
            </a>
            <button type="submit" 
                    style="padding:12px 24px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border:none;border-radius:8px;font-weight:600;transition:all 0.3s;cursor:pointer"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 16px rgba(79,70,229,0.3)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                ✓ Créer la Classe
            </button>
        </div>
    </form>
</div>
@endsection
