@extends('layouts.app')

@section('page-title', $classroom->name)

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
    .student-item {
        padding: 12px;
        background: #f8fafc;
        border-left: 4px solid #4f46e5;
        border-radius: 6px;
        margin-bottom: 12px;
    }
</style>

<div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;margin-bottom:24px">
    <!-- Classroom Card -->
    <div>
        <div class="info-card">
            <!-- Header with gradient -->
            <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);height:100px;border-radius:12px;margin:-24px -24px 0 -24px"></div>
            
            <div style="display:flex;flex-direction:column;align-items:center;margin-top:-40px;margin-bottom:20px">
                <div style="width:80px;height:80px;border-radius:50%;border:4px solid #fff;background:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:40px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                    🏫
                </div>
            </div>

            <h2 style="text-align:center;font-size:20px;font-weight:700;color:#1f2937;margin:0">{{ $classroom->name }}</h2>

            <div style="margin-top:20px;padding-top:20px;border-top:1px solid #f3f4f6">
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Niveau</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $classroom->level->name }}</p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Cycle</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">
                        @if($classroom->level->cycle === 'primaire')
                            <span style="display:inline-block;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#e0e7ff;color:#312e81">
                                {{ ucfirst($classroom->level->cycle) }}
                            </span>
                        @elseif($classroom->level->cycle === 'secondaire')
                            <span style="display:inline-block;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#fef3c7;color:#78350f">
                                {{ ucfirst($classroom->level->cycle) }}
                            </span>
                        @else
                            <span style="display:inline-block;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#d1fae5;color:#065f46">
                                {{ ucfirst($classroom->level->cycle) }}
                            </span>
                        @endif
                    </p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Année Académique</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $classroom->academicYear->label }}</p>
                </div>
                <div style="margin-bottom:12px">
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Capacité</p>
                    <p style="margin:4px 0 0;font-size:14px;font-weight:600;color:#1f2937">{{ $classroom->capacity }} places</p>
                </div>
                <div>
                    <p style="margin:0;font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase">Effectif</p>
                    <p style="margin:4px 0 0;font-size:18px;font-weight:700;color:#4f46e5">
                        {{ $classroom->students->count() }} / {{ $classroom->capacity }}
                    </p>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;padding-top:20px;border-top:1px solid #f3f4f6">
                <a href="{{ route('classrooms.edit', $classroom) }}" 
                   style="flex:1;text-align:center;padding:10px 12px;background:#fef08a;color:#92400e;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;border:none;cursor:pointer;display:inline-block"
                   onmouseover="this.style.background='#fde047';this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.background='#fef08a';this.style.transform='translateY(0)'">
                    ✏️ Éditer
                </a>
                <form method="POST" action="{{ route('classrooms.destroy', $classroom) }}" 
                      style="flex:1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe?');">
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

    <!-- Students List -->
    <div>
        <div class="info-card">
            <h3 style="margin:0 0 16px;font-size:16px;font-weight:700;color:#1f2937">👥 Étudiants ({{ $classroom->students->count() }})</h3>

            @if($classroom->students->count())
                <div>
                    @foreach($classroom->students as $student)
                    <div class="student-item">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <div style="flex:1">
                                <p style="margin:0;font-weight:600;color:#1f2937;font-size:14px">{{ $student->full_name }}</p>
                                <p style="margin:4px 0 0;color:#6b7280;font-size:12px">📋 {{ $student->registration_number }}</p>
                            </div>
                            <div style="text-align:right">
                                <p style="margin:0;font-size:12px;color:#6b7280;margin-bottom:6px">
                                    @if($student->gender === 'M') 🧑‍💼 M @else 👩‍💼 F @endif
                                </p>
                                <a href="{{ route('students.show', $student) }}" 
                                   style="display:inline-block;padding:6px 14px;background:#dbeafe;color:#1e40af;text-decoration:none;border-radius:6px;font-weight:600;font-size:12px;transition:all 0.3s;border:none;cursor:pointer"
                                   onmouseover="this.style.background='#bfdbfe';this.style.transform='translateY(-2px)'"
                                   onmouseout="this.style.background='#dbeafe';this.style.transform='translateY(0)'">
                                    👁️ Voir
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="text-align:center;color:#9ca3af;padding:24px 0;margin:0">📭 Aucun étudiant dans cette classe</p>
            @endif
        </div>
    </div>
</div>

<div style="margin-top:24px;padding-top:24px">
    <a href="{{ route('classrooms.index') }}" 
       style="color:#4f46e5;text-decoration:none;font-weight:600;transition:color 0.3s"
       onmouseover="this.style.color='#6366f1'"
       onmouseout="this.style.color='#4f46e5'">
        ← Retour à la liste
    </a>
</div>
@endsection
