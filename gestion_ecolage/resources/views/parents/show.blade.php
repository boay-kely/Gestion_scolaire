@extends('layouts.app')

@section('title', 'Détail Parent - Gestion d\'Écolage')
@section('page-title', 'Détail du Parent')
@section('page-subtitle', $parent->full_name)

@section('content')
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <div class="card">
            <h3 style="margin-top:0;margin-bottom:16px">Informations personnelles</h3>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Nom complet</label>
                <p style="margin:6px 0 0;font-size:16px">{{ $parent->full_name }}</p>
            </div>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Email</label>
                <p style="margin:6px 0 0"><a href="mailto:{{ $parent->email }}" class="link-primary">{{ $parent->email }}</a></p>
            </div>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Téléphone principal</label>
                <p style="margin:6px 0 0"><a href="tel:{{ $parent->phone }}" class="link-primary">{{ $parent->phone }}</a></p>
            </div>

            @if ($parent->phone_secondary)
                <div style="margin-bottom:12px">
                    <label style="font-weight:600;color:var(--muted);font-size:12px">Téléphone secondaire</label>
                    <p style="margin:6px 0 0"><a href="tel:{{ $parent->phone_secondary }}" class="link-primary">{{ $parent->phone_secondary }}</a></p>
                </div>
            @endif
        </div>

        <div class="card">
            <h3 style="margin-top:0;margin-bottom:16px">Détails professionnels</h3>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Lien de parenté</label>
                <p style="margin:6px 0 0">{{ $parent->relationship ?? '-' }}</p>
            </div>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Occupation / Profession</label>
                <p style="margin:6px 0 0">{{ $parent->occupation ?? '-' }}</p>
            </div>

            <div style="margin-bottom:12px">
                <label style="font-weight:600;color:var(--muted);font-size:12px">Revenu annuel estimé</label>
                <p style="margin:6px 0 0">{{ $parent->annual_income ? '$' . number_format($parent->annual_income, 2) : '-' }}</p>
            </div>
        </div>
    </div>

    @if ($parent->address)
        <div class="card" style="margin-top:20px">
            <h3 style="margin-top:0;margin-bottom:16px">Adresse</h3>
            <p style="margin:0;white-space:pre-wrap">{{ $parent->address }}</p>
        </div>
    @endif

    @if ($parent->notes)
        <div class="card" style="margin-top:20px">
            <h3 style="margin-top:0;margin-bottom:16px">Notes</h3>
            <p style="margin:0;white-space:pre-wrap">{{ $parent->notes }}</p>
        </div>
    @endif

    <div style="display:flex;gap:12px;margin-top:20px">
        <a href="{{ route('parents.edit', $parent) }}" class="btn btn-primary">✏️ Modifier</a>
        <a href="{{ route('parents.index') }}" class="btn btn-ghost">← Retour à la liste</a>
        <form action="{{ route('parents.destroy', $parent) }}" method="POST" style="display:inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parent ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background:#dc2626;color:#fff;border:none;cursor:pointer">🗑️ Supprimer</button>
        </form>
    </div>
@endsection
