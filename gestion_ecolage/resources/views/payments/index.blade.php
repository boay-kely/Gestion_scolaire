@extends('layouts.app')

@section('page-title', 'Gestion des Paiements')

@section('content')
<style>
    .payment-row {
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    .payment-row:nth-child(odd) {
        background: #fff;
    }
    .payment-row:nth-child(even) {
        background: #fafafa;
    }
    .payment-row:hover {
        background: #f9fafb !important;
        box-shadow: inset 0 0 0 1px rgba(16,185,129,0.1);
    }
</style>

<!-- Header Section -->
<div class="mb-8">
    <div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:32px;color:#fff;box-shadow:0 4px 12px rgba(16,185,129,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
                <h2 style="margin:0;font-size:28px;font-weight:700">💳 Gestion des Paiements</h2>
                <p style="margin:8px 0 0;opacity:0.9;font-size:15px">Tableau de suivi des paiements des étudiants</p>
            </div>
            <a href="{{ route('payments.create') }}" 
               style="background:#fff;color:#10b981;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all 0.3s;display:inline-block">
                ➕ Nouveau Paiement
            </a>
        </div>
    </div>
</div>

<!-- Payments Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);overflow:hidden">
    <div style="overflow-x:auto">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb);border-bottom:2px solid #e5e7eb">
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Matricule</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Étudiant</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Type de Frais</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Montant</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Mode</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Date</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Comptable</th>
                    <th style="padding:16px;text-align:center;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                @if($payment->student)
                <tr class="payment-row">
                    <td style="padding:16px;font-size:13px;font-family:monospace;font-weight:600;color:#10b981">{{ $payment->student->registration_number }}</td>
                    <td style="padding:16px;font-size:14px;font-weight:600;color:#1f2937">{{ $payment->student->full_name }}</td>
                    <td style="padding:16px;font-size:14px;color:#374151">{{ $payment->feeType->name }}</td>
                    <td style="padding:16px;font-size:14px;font-weight:700;color:#10b981">{{ number_format($payment->amount, 0) }} FCFA</td>
                    <td style="padding:16px;font-size:13px">
                        <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#dbeafe;color:#1e40af">
                            💳 {{ ucfirst($payment->payment_mode) }}
                        </span>
                    </td>
                    <td style="padding:16px;font-size:14px;color:#6b7280">
                        @if(is_string($payment->created_at))
                            {{ $payment->created_at }}
                        @else
                            {{ $payment->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                    <td style="padding:16px;font-size:14px;color:#374151">{{ $payment->processedBy->name }}</td>
                    <td style="padding:16px;text-align:center">
                        <div style="display:flex;justify-content:center;gap:8px">
                            <a href="{{ route('payments.show', $payment) }}" 
                               style="padding:6px 12px;background:#dbeafe;color:#1e40af;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               onmouseover="this.style.background='#93c5fd';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#dbeafe';this.style.transform='translateY(0)'">
                                👁️ Voir
                            </a>
                            @if($payment->receipt)
                            <a href="{{ route('receipts.print', $payment->receipt) }}" 
                               style="padding:6px 12px;background:#d1fae5;color:#065f46;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               target="_blank"
                               onmouseover="this.style.background='#a7f3d0';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#d1fae5';this.style.transform='translateY(0)'">
                                🖨️ Reçu
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="8" style="padding:48px 16px;text-align:center">
                        <div style="color:#9ca3af">
                            <p style="font-size:18px;margin:0;margin-bottom:8px">💳 Aucun paiement enregistré</p>
                            <p style="font-size:13px;margin:0">Commencez par enregistrer un nouveau paiement</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="margin-top:24px;padding:16px">
        {{ $payments->links('pagination::custom') }}
    </div>
</div>
@endsection
