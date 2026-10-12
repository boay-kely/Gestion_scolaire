@extends('layouts.app')

@section('page-title', 'Gestion des Classes')

@section('content')
<style>
    .classroom-row {
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    .classroom-row:nth-child(odd) {
        background: #fff;
    }
    .classroom-row:nth-child(even) {
        background: #fafafa;
    }
    .classroom-row:hover {
        background: #f9fafb !important;
        box-shadow: inset 0 0 0 1px rgba(79,70,229,0.1);
    }
    .progress-bar {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
    }
</style>

<!-- Header Section -->
<div class="mb-8">
    <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:12px;padding:32px;color:#fff;box-shadow:0 4px 12px rgba(79,70,229,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
                <h2 style="margin:0;font-size:28px;font-weight:700">🏫 Gestion des Classes</h2>
                <p style="margin:8px 0 0;opacity:0.9;font-size:15px">Visualisez les classes et leurs effectifs</p>
            </div>
            <a href="{{ route('classrooms.create') }}" 
               style="background:#fff;color:#4f46e5;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all 0.3s;display:inline-block">
                ➕ Nouvelle Classe
            </a>
        </div>
    </div>
</div>

<!-- Classrooms Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);overflow:hidden">
    <div style="overflow-x:auto">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb);border-bottom:2px solid #e5e7eb">
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Classe</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Niveau</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Cycle</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Année</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Effectif</th>
                    <th style="padding:16px;text-align:center;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classrooms as $classroom)
                <tr class="classroom-row">
                    <td style="padding:16px;font-size:14px;font-weight:600;color:#1f2937">{{ $classroom->name }}</td>
                    <td style="padding:16px;font-size:14px;color:#374151">{{ $classroom->level->name }}</td>
                    <td style="padding:16px;font-size:13px">
                        @if($classroom->level->cycle === 'primaire')
                            <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#e0e7ff;color:#312e81">
                                📚 Primaire
                            </span>
                        @elseif($classroom->level->cycle === 'secondaire')
                            <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#fef08a;color:#92400e">
                                🎓 Secondaire
                            </span>
                        @else
                            <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#d1fae5;color:#065f46">
                                🎯 Autre
                            </span>
                        @endif
                    </td>
                    <td style="padding:16px;font-size:14px;color:#374151">{{ $classroom->academicYear->label }}</td>
                    <td style="padding:16px;font-size:14px">
                        <div style="display:flex;align-items:center;gap:8px;min-width:150px">
                            <span style="font-weight:700;color:#1f2937;white-space:nowrap">{{ $classroom->students->count() }}/{{ $classroom->capacity }}</span>
                            <div class="progress-bar" style="flex-grow:1">
                                @php
                                    $pct = ($classroom->capacity > 0) ? (($classroom->students->count() / $classroom->capacity) * 100) : 0;
                                @endphp
                                <div style="height:100%;background:linear-gradient(90deg,#4f46e5,#7c3aed);border-radius:3px" data-width="{{ $pct }}"></div>
                            </div>
                        </div>
                        <script>
                            document.querySelectorAll('[data-width]').forEach(el => {
                                el.style.width = el.getAttribute('data-width') + '%';
                            });
                        </script>
                    </td>
                    <td style="padding:16px;text-align:center">
                        <div style="display:flex;justify-content:center;gap:8px">
                            <a href="{{ route('classrooms.show', $classroom) }}" 
                               style="padding:6px 12px;background:#dbeafe;color:#1e40af;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               onmouseover="this.style.background='#93c5fd';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#dbeafe';this.style.transform='translateY(0)'">
                                👁️ Voir
                            </a>
                            <a href="{{ route('classrooms.edit', $classroom) }}" 
                               style="padding:6px 12px;background:#fef08a;color:#92400e;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               onmouseover="this.style.background='#fde047';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#fef08a';this.style.transform='translateY(0)'">
                                ✏️ Éditer
                            </a>
                            <form method="POST" action="{{ route('classrooms.destroy', $classroom) }}" 
                                  style="display:inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe?');">
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
                @empty
                <tr>
                    <td colspan="6" style="padding:48px 16px;text-align:center">
                        <div style="color:#9ca3af">
                            <p style="font-size:18px;margin:0;margin-bottom:8px">🏫 Aucune classe trouvée</p>
                            <p style="font-size:13px;margin:0">Commencez par créer une nouvelle classe</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top:24px;padding:16px">
        {{ $classrooms->links('pagination::custom') }}
    </div>
</div>
@endsection
