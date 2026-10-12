@extends('layouts.app')

@section('title', 'Parents - Gestion d\'Écolage')
@section('page-title', 'Liste des Parents')

@section('content')
<style>
    .parent-row {
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    .parent-row:nth-child(odd) {
        background: #fff;
    }
    .parent-row:nth-child(even) {
        background: #fafafa;
    }
    .parent-row:hover {
        background: #f9fafb !important;
        box-shadow: inset 0 0 0 1px rgba(236,72,153,0.1);
    }
</style>

<!-- Header Section -->
<div class="mb-8">
    <div style="background:linear-gradient(135deg,#ec4899,#be185d);border-radius:12px;padding:32px;color:#fff;box-shadow:0 4px 12px rgba(236,72,153,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
                <h2 style="margin:0;font-size:28px;font-weight:700">👨‍👩‍👧 Gestion des Parents</h2>
                <p style="margin:8px 0 0;opacity:0.9;font-size:15px">Consultez et gérez la liste des parents/tuteurs</p>
            </div>
            <a href="{{ route('parents.create') }}" 
               style="background:#fff;color:#ec4899;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all 0.3s;display:inline-block">
                ➕ Ajouter un Parent
            </a>
        </div>
    </div>
</div>

<!-- Parents Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);overflow:hidden">
    @if ($parents->count() > 0)
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse">
                <thead>
                    <tr style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb);border-bottom:2px solid #e5e7eb">
                        <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Nom Complet</th>
                        <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Email</th>
                        <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Téléphone</th>
                        <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Occupation</th>
                        <th style="padding:16px;text-align:center;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $parent)
                        <tr class="parent-row">
                            <td style="padding:16px;font-size:14px;font-weight:600;color:#1f2937">{{ $parent->full_name }}</td>
                            <td style="padding:16px;font-size:14px;color:#6b7280">{{ $parent->email }}</td>
                            <td style="padding:16px;font-size:14px;color:#6b7280">{{ $parent->phone }}</td>
                            <td style="padding:16px;font-size:14px;color:#6b7280">
                                <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:6px;font-size:12px;font-weight:600;background:#f3f4f6;color:#374151">
                                    {{ $parent->occupation ?? '-' }}
                                </span>
                            </td>
                            <td style="padding:16px;text-align:center">
                                <div style="display:flex;justify-content:center;gap:8px">
                                    <a href="{{ route('parents.show', $parent) }}" 
                                       style="padding:6px 12px;background:#dbeafe;color:#1e40af;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                                       onmouseover="this.style.background='#93c5fd';this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='#dbeafe';this.style.transform='translateY(0)'">
                                        👁️ Voir
                                    </a>
                                    <a href="{{ route('parents.edit', $parent) }}" 
                                       style="padding:6px 12px;background:#fef08a;color:#92400e;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                                       onmouseover="this.style.background='#fde047';this.style.transform='translateY(-2px)'"
                                       onmouseout="this.style.background='#fef08a';this.style.transform='translateY(0)'">
                                        ✏️ Éditer
                                    </a>
                                    <form method="POST" action="{{ route('parents.destroy', $parent) }}" 
                                          style="display:inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parent?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding:6px 12px;background:#fee2e2;color:#991b1b;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                                                onmouseover="this.style.background='#fecaca';this.style.transform='translateY(-2px)'"
                                                onmouseout="this.style.background='#fee2e2';this.style.transform='translateY(0)'">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top:24px;padding:16px">
            {{ $parents->links('pagination::custom') }}
        </div>
    @else
        <div style="text-align:center;padding:48px 16px;color:#9ca3af">
            <p style="font-size:18px;margin:0;margin-bottom:8px">👥 Aucun parent trouvé</p>
            <p style="font-size:13px;margin:0">Commencez par ajouter un nouveau parent</p>
        </div>
    @endif
</div>
@endsection
