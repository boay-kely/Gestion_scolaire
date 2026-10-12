@extends('layouts.app')

@section('page-title', 'Tableau de Bord')
@section('page-subtitle', 'Bienvenue sur votre système de gestion d\'écolage')

@section('content')
<!-- Stats Cards Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;margin-bottom:24px">
    <!-- Total Students -->
    <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:12px;padding:20px;color:#fff;box-shadow:0 4px 12px rgba(79,70,229,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
            <div>
                <p style="margin:0;font-size:13px;opacity:0.9;font-weight:600">Total Étudiants</p>
                <p style="margin:8px 0 0;font-size:32px;font-weight:700">{{ \App\Models\Student::count() }}</p>
                <p style="margin:6px 0 0;font-size:12px;opacity:0.8">Inscrits dans le système</p>
            </div>
            <div style="font-size:40px;opacity:0.15">👥</div>
        </div>
    </div>

    <!-- Total Classes -->
    <div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:20px;color:#fff;box-shadow:0 4px 12px rgba(16,185,129,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
            <div>
                <p style="margin:0;font-size:13px;opacity:0.9;font-weight:600">Classes Actives</p>
                <p style="margin:8px 0 0;font-size:32px;font-weight:700">{{ \App\Models\Classroom::count() }}</p>
                <p style="margin:6px 0 0;font-size:12px;opacity:0.8">Salles de classe</p>
            </div>
            <div style="font-size:40px;opacity:0.15">🏫</div>
        </div>
    </div>

    <!-- Monthly Payments -->
    <div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;padding:20px;color:#fff;box-shadow:0 4px 12px rgba(245,158,11,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
            <div>
                <p style="margin:0;font-size:13px;opacity:0.9;font-weight:600">Paiements ce Mois</p>
                <p style="margin:8px 0 0;font-size:28px;font-weight:700">{{ \App\Models\Payment::whereMonth('created_at', now()->month)->count() }}</p>
                <p style="margin:6px 0 0;font-size:12px;opacity:0.8">{{ number_format(\App\Models\Payment::whereMonth('created_at', now()->month)->sum('amount'), 0) }} FCFA</p>
            </div>
            <div style="font-size:40px;opacity:0.15">💳</div>
        </div>
    </div>

    <!-- Total Parents -->
    <div style="background:linear-gradient(135deg,#ec4899,#be185d);border-radius:12px;padding:20px;color:#fff;box-shadow:0 4px 12px rgba(236,72,153,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
            <div>
                <p style="margin:0;font-size:13px;opacity:0.9;font-weight:600">Parents</p>
                <p style="margin:8px 0 0;font-size:32px;font-weight:700">{{ \App\Models\ParentGuardian::count() }}</p>
                <p style="margin:6px 0 0;font-size:12px;opacity:0.8">Tuteurs enregistrés</p>
            </div>
            <div style="font-size:40px;opacity:0.15">👨‍👩‍👧</div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(450px,1fr));gap:20px;margin-bottom:24px">
    <!-- Recent Payments -->
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #f1f5f9">
            <h3 style="margin:0;font-size:18px;font-weight:700;color:var(--text)">📊 Derniers Paiements</h3>
            <a href="{{ route('payments.index') }}" class="link-primary" style="font-size:12px">Voir plus →</a>
        </div>
        @php
        $recentPayments = \App\Models\Payment::with(['student', 'feeType'])->latest()->limit(6)->get();
        @endphp
        @if($recentPayments->count())
            <div style="display:flex;flex-direction:column;gap:10px">
                @foreach($recentPayments as $payment)
                    @if($payment->student)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:12px;background:#f8fafc;border-radius:8px;border-left:4px solid var(--primary)">
                        <div>
                            <p style="margin:0;font-weight:600;color:var(--text);font-size:14px">{{ $payment->student->full_name }}</p>
                            <p style="margin:4px 0 0;color:var(--muted);font-size:12px">{{ $payment->feeType->name ?? 'N/A' }}</p>
                        </div>
                        <div style="text-align:right">
                            <p style="margin:0;font-weight:700;color:#10b981;font-size:14px">{{ number_format($payment->amount, 0) }} FCFA</p>
                            <p style="margin:4px 0 0;color:var(--muted);font-size:11px">{{ $payment->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <p style="text-align:center;color:var(--muted);padding:24px 0;margin:0">Aucun paiement récent</p>
        @endif
    </div>


</div>

<!-- Bottom Section: Recent Students & Summary -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:20px">
    <!-- Recent Students -->
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #f1f5f9">
            <h3 style="margin:0;font-size:18px;font-weight:700;color:var(--text)">👥 Étudiants Récemment Ajoutés</h3>
            <a href="{{ route('students.index') }}" class="link-primary" style="font-size:12px">Voir tous →</a>
        </div>
        @php
        $recentStudents = \App\Models\Student::latest()->limit(5)->get();
        @endphp
        @if($recentStudents->count())
            <div style="display:flex;flex-direction:column;gap:8px">
                @foreach($recentStudents as $student)
                    <div style="padding:10px;background:#f8fafc;border-radius:8px;display:flex;justify-content:space-between;align-items:center">
                        <div>
                            <p style="margin:0;font-weight:600;color:var(--text);font-size:14px">{{ $student->full_name }}</p>
                            <p style="margin:4px 0 0;color:var(--muted);font-size:12px">{{ $student->classroom->name ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ route('students.show', $student) }}" class="link-primary" style="font-size:12px">Voir →</a>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align:center;color:var(--muted);padding:24px 0;margin:0">Aucun étudiant</p>
        @endif
    </div>

    <!-- Summary Stats -->
    <div class="card">
        <div style="margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #f1f5f9">
            <h3 style="margin:0;font-size:18px;font-weight:700;color:var(--text)">📈 Résumé Mensuel</h3>
        </div>
        <div style="display:flex;flex-direction:column;gap:14px">
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f1f5f9">
                <span style="color:var(--muted);font-size:14px">Total des Paiements</span>
                <span style="font-weight:700;color:var(--text)">{{ number_format(\App\Models\Payment::whereMonth('created_at', now()->month)->sum('amount'), 0) }} FCFA</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f1f5f9">
                <span style="color:var(--muted);font-size:14px">Taux de Paiement</span>
                <span style="font-weight:700;color:#10b981">{{ \App\Models\Student::count() > 0 ? round((\App\Models\Payment::whereMonth('created_at', now()->month)->count() / \App\Models\Student::count()) * 100, 1) : 0 }}%</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f1f5f9">
                <span style="color:var(--muted);font-size:14px">Étudiants Actifs</span>
                <span style="font-weight:700;color:var(--text)">{{ \App\Models\Student::count() }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0">
                <span style="color:var(--muted);font-size:14px">Utilisateurs Actifs</span>
                <span style="font-weight:700;color:var(--text)">{{ \App\Models\User::count() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
