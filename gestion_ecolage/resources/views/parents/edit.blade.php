@extends('layouts.app')

@section('title', 'Modifier Parent - Gestion d\'Écolage')
@section('page-title', 'Modifier Parent')
@section('page-subtitle', 'Mettez à jour les informations du parent')

@section('content')
    <div class="card" style="max-width:600px">
        <form method="POST" action="{{ route('parents.update', $parent) }}" class="form-stack">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div class="form-group">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $parent->first_name) }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Nom de famille</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $parent->last_name) }}" required class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Adresse e-mail</label>
                <input type="email" name="email" value="{{ old('email', $parent->email) }}" required class="form-input">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div class="form-group">
                    <label class="form-label">Téléphone principal</label>
                    <input type="text" name="phone" value="{{ old('phone', $parent->phone) }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Téléphone secondaire</label>
                    <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $parent->phone_secondary) }}" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Adresse</label>
                <textarea name="address" class="form-input" rows="3">{{ old('address', $parent->address) }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div class="form-group">
                    <label class="form-label">Profession / Occupation</label>
                    <input type="text" name="occupation" value="{{ old('occupation', $parent->occupation) }}" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Lien de parenté</label>
                    <select name="relationship" class="form-input">
                        <option value="">-- Sélectionner --</option>
                        <option value="Père" @selected(old('relationship', $parent->relationship) === 'Père')>Père</option>
                        <option value="Mère" @selected(old('relationship', $parent->relationship) === 'Mère')>Mère</option>
                        <option value="Tuteur" @selected(old('relationship', $parent->relationship) === 'Tuteur')>Tuteur</option>
                        <option value="Grand-parent" @selected(old('relationship', $parent->relationship) === 'Grand-parent')>Grand-parent</option>
                        <option value="Autre" @selected(old('relationship', $parent->relationship) === 'Autre')>Autre</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Revenu annuel estimé</label>
                <input type="number" name="annual_income" value="{{ old('annual_income', $parent->annual_income) }}" class="form-input" step="0.01">
            </div>

            <div class="form-group">
                <label class="form-label">Notes / Observations</label>
                <textarea name="notes" class="form-input" rows="4">{{ old('notes', $parent->notes) }}</textarea>
            </div>

            <div style="display:flex;gap:12px;justify-content:flex-end">
                <a href="{{ route('parents.index') }}" class="btn btn-ghost">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            </div>
        </form>
    </div>
@endsection
