@extends('layouts.app')

@section('page-title', 'Éditer ' . $student->full_name)

@section('content')
<style>
    input[type="text"], input[type="date"], select, input[type="file"] {
        transition: all 0.3s ease;
    }
    input[type="text"]:hover, input[type="date"]:hover, select:hover, input[type="file"]:hover {
        border-color: #f59e0b !important;
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
    .photo-preview {
        margin-top: 12px;
        position: relative;
        display: inline-block;
    }
    .photo-preview img {
        height: 120px;
        width: 120px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid #f59e0b;
    }
</style>

<div style="max-width:700px;margin:0 auto">
    <!-- Header -->
    <div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;padding:24px;color:#fff;margin-bottom:24px;box-shadow:0 4px 12px rgba(245,158,11,0.15)">
        <h2 style="margin:0;font-size:24px;font-weight:700">✏️ Éditer un Étudiant</h2>
        <p style="margin:8px 0 0;opacity:0.9">Modifiez les informations de {{ $student->full_name }}</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data" 
          style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px">
        @csrf
        @method('PUT')

        <!-- Registration Number -->
        <div class="form-group">
            <label for="registration_number" class="form-label">📋 Matricule *</label>
            <input type="text" id="registration_number" name="registration_number" 
                   value="{{ old('registration_number', $student->registration_number) }}"
                   class="form-input @error('registration_number') error @enderror"
                   placeholder="Saisir le matricule unique"
                   required>
            @error('registration_number')
            <p class="error-message">⚠️ {!! $message !!}</p>
            @enderror
        </div>

        <!-- First & Last Name -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="first_name" class="form-label">👤 Prénom *</label>
                <input type="text" id="first_name" name="first_name" 
                       value="{{ old('first_name', $student->first_name) }}"
                       class="form-input @error('first_name') error @enderror"
                       required>
                @error('first_name')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="last_name" class="form-label">👤 Nom *</label>
                <input type="text" id="last_name" name="last_name" 
                       value="{{ old('last_name', $student->last_name) }}"
                       class="form-input @error('last_name') error @enderror"
                       required>
                @error('last_name')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Gender & Birth Date -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="gender" class="form-label">⚧️ Genre *</label>
                <select id="gender" name="gender" 
                        class="form-input @error('gender') error @enderror"
                        required>
                    <option value="M" @selected(old('gender', $student->gender) === 'M')>Masculin</option>
                    <option value="F" @selected(old('gender', $student->gender) === 'F')>Féminin</option>
                </select>
                @error('gender')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="birth_date" class="form-label">🗓️ Date de Naissance *</label>
                <input type="date" id="birth_date" name="birth_date" 
                       value="{{ old('birth_date', is_string($student->birth_date) ? $student->birth_date : $student->birth_date->format('Y-m-d')) }}"
                       class="form-input @error('birth_date') error @enderror"
                       required>
                @error('birth_date')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Birth Place -->
        <div class="form-group">
            <label for="birth_place" class="form-label">📍 Lieu de Naissance *</label>
            <input type="text" id="birth_place" name="birth_place" 
                   value="{{ old('birth_place', $student->birth_place) }}"
                   class="form-input @error('birth_place') error @enderror"
                   required>
            @error('birth_place')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Classroom & Parent -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group" style="margin-bottom:0">
                <label for="classroom_id" class="form-label">🏫 Classe *</label>
                <select id="classroom_id" name="classroom_id" 
                        class="form-input @error('classroom_id') error @enderror"
                        required>
                    @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" @selected(old('classroom_id', $student->classroom_id) == $classroom->id)>
                        {{ $classroom->name }} - {{ $classroom->level->name }}
                    </option>
                    @endforeach
                </select>
                @error('classroom_id')
                <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:0">
                <label for="parent_search" class="form-label">👨‍👩‍👧 Parent/Tuteur</label>
                <div style="position: relative;">
                    <input type="text" id="parent_search" placeholder="Rechercher un parent..." 
                           value="{{ $student->parentGuardian->full_name ?? '' }}"
                           style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px 8px 0 0;font-size:14px;box-sizing:border-box;"
                           autocomplete="off">
                    <select id="parent_guardian_id" name="parent_guardian_id" 
                            style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:0;font-size:14px;box-sizing:border-box;display:none"
                            class="form-input">
                        <option value="">-- Sélectionner --</option>
                        @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" @selected(old('parent_guardian_id', $student->parent_guardian_id) == $parent->id)>
                            {{ $parent->full_name }} (📞 {{ $parent->phone }})
                        </option>
                        @endforeach
                    </select>
                    <div id="search_results" style="position:absolute;top:100%;left:0;right:0;border:1px solid #e5e7eb;border-top:none;background:#fff;max-height:200px;overflow-y:auto;z-index:10;display:none;border-radius:0 0 8px 8px;box-shadow:0 4px 12px rgba(0,0,0,0.08)"></div>
                </div>
            </div>
        </div>

        <script>
        let parentsData = [];
        @foreach($parents as $parent)
        parentsData.push({
            id: {{ $parent->id }},
            full_name: '{{ $parent->full_name }}',
            phone: '{{ $parent->phone }}',
            email: '{{ $parent->email }}'
        });
        @endforeach

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('parent_search');
            const selectParent = document.getElementById('parent_guardian_id');
            const resultsDiv = document.getElementById('search_results');

            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                
                if (query.length === 0) {
                    resultsDiv.style.display = 'none';
                    selectParent.style.display = 'none';
                    return;
                }

                const filtered = parentsData.filter(parent => 
                    parent.full_name.toLowerCase().includes(query) ||
                    parent.phone.includes(query) ||
                    parent.email.toLowerCase().includes(query)
                );

                if (filtered.length === 0) {
                    resultsDiv.innerHTML = '<div style="padding:12px;color:#6b7280">Aucun parent trouvé</div>';
                    resultsDiv.style.display = 'block';
                    selectParent.style.display = 'none';
                    return;
                }

                let html = '';
                filtered.forEach(parent => {
                    html += `<div style="padding:12px 16px;border-bottom:1px solid #f3f4f6;cursor:pointer;transition:background 0.2s"
                                   onmouseover="this.style.background='#f9fafb'"
                                   onmouseout="this.style.background=''"
                                   onclick="selectParentOption(${parent.id}, '${parent.full_name.replace(/'/g, "\\'")}')">
                                <div style="font-weight:600;color:#1f2937">${parent.full_name}</div>
                                <div style="font-size:12px;color:#6b7280">📞 ${parent.phone}</div>
                            </div>`;
                });

                resultsDiv.innerHTML = html;
                resultsDiv.style.display = 'block';
                selectParent.style.display = 'none';
            });

            window.selectParentOption = function(id, name) {
                selectParent.value = id;
                searchInput.value = name;
                resultsDiv.style.display = 'none';
                selectParent.style.display = 'none';
            };

            document.addEventListener('click', function(e) {
                if (e.target !== searchInput && e.target !== resultsDiv && !resultsDiv.contains(e.target)) {
                    resultsDiv.style.display = 'none';
                }
            });
        });
        </script>

        <!-- Photo -->
        <div class="form-group">
            <label for="photo" class="form-label">📸 Photo</label>
            @if($student->photo)
            <div class="photo-preview">
                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->full_name }}">
            </div>
            @endif
            <input type="file" id="photo" name="photo" accept="image/*" class="form-input" style="margin-top:12px">
            @error('photo')
            <p class="error-message">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid #e5e7eb">
            <a href="{{ route('students.show', $student) }}" 
               style="padding:12px 24px;border:2px solid #e5e7eb;background:#fff;color:#374151;border-radius:8px;text-decoration:none;font-weight:600;transition:all 0.3s"
               onmouseover="this.style.background='#f3f4f6'"
               onmouseout="this.style.background='#fff'">
                ✗ Annuler
            </a>
            <button type="submit" 
                    style="padding:12px 24px;background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;border:none;border-radius:8px;font-weight:600;transition:all 0.3s;cursor:pointer"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 16px rgba(245,158,11,0.3)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                ✓ Mettre à Jour
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const birthDateInput = document.getElementById('birth_date');
    const form = document.querySelector('form');

    // Validation stricte de la date de naissance
    form.addEventListener('submit', function(e) {
        if (birthDateInput.value) {
            let dateValue = birthDateInput.value.trim();
            
            // Gérer différents formats d'entrée
            let year, month, day;
            
            // Format DD/MM/YYYY
            if (dateValue.includes('/')) {
                const parts = dateValue.split('/');
                if (parts.length === 3) {
                    day = parseInt(parts[0]);
                    month = parseInt(parts[1]);
                    year = parseInt(parts[2]);
                    
                    // Corriger les années à 4 chiffres mal saisies
                    if (year > 9999 || (year > 100 && year < 1000)) {
                        e.preventDefault();
                        birthDateInput.style.borderColor = '#dc2626';
                        alert('⚠️ L\'année saisie est invalide. Format attendu: DD/MM/YYYY');
                        return false;
                    }
                    
                    // Reformater en YYYY-MM-DD
                    dateValue = year + '-' + String(month).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                    birthDateInput.value = dateValue;
                }
            }
            // Format YYYY-MM-DD (format standard HTML date)
            else if (dateValue.includes('-')) {
                const parts = dateValue.split('-');
                if (parts.length === 3) {
                    year = parseInt(parts[0]);
                    month = parseInt(parts[1]);
                    day = parseInt(parts[2]);
                }
            }
            
            if (year && month && day) {
                // Vérifier que l'année est valide (entre 1900 et l'année actuelle)
                const currentYear = new Date().getFullYear();
                if (year < 1900 || year > currentYear) {
                    e.preventDefault();
                    birthDateInput.style.borderColor = '#dc2626';
                    alert('⚠️ L\'année doit être entre 1900 et ' + currentYear + '.\nVous avez saisi: ' + year);
                    return false;
                }
                
                // Vérifier que le mois est valide
                if (month < 1 || month > 12) {
                    e.preventDefault();
                    birthDateInput.style.borderColor = '#dc2626';
                    alert('⚠️ Le mois doit être entre 1 et 12');
                    return false;
                }
                
                // Vérifier que le jour est valide
                if (day < 1 || day > 31) {
                    e.preventDefault();
                    birthDateInput.style.borderColor = '#dc2626';
                    alert('⚠️ Le jour doit être entre 1 et 31');
                    return false;
                }
                
                // Vérifier que la date est valide (ex: pas le 31 février)
                const dateObj = new Date(year, month - 1, day);
                if (dateObj.getDate() !== day || dateObj.getMonth() !== month - 1 || dateObj.getFullYear() !== year) {
                    e.preventDefault();
                    birthDateInput.style.borderColor = '#dc2626';
                    alert('⚠️ La date saisie n\'est pas valide');
                    return false;
                }
                
                // Formater en YYYY-MM-DD pour Laravel
                birthDateInput.value = year + '-' + String(month).padStart(2, '0') + '-' + String(day).padStart(2, '0');
            }
        }
    });

    // Réinitialiser la bordure au focus
    birthDateInput.addEventListener('focus', function() {
        this.style.borderColor = '#e5e7eb';
    });

    // Aide à la saisie: afficher format attendu
    birthDateInput.addEventListener('blur', function() {
        if (this.value && !this.value.match(/^\d{4}-\d{2}-\d{2}$/)) {
            let dateValue = this.value.trim();
            let year, month, day;
            
            if (dateValue.includes('/')) {
                const parts = dateValue.split('/');
                if (parts.length === 3) {
                    day = parseInt(parts[0]);
                    month = parseInt(parts[1]);
                    year = parseInt(parts[2]);
                    
                    if (year && month && day) {
                        this.value = year + '-' + String(month).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                    }
                }
            }
        }
    });
});
</script>
@endsection
