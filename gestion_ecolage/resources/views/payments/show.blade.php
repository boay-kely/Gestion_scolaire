@extends('layouts.app')

@section('page-title', 'Détail du Paiement')

@section('content')
<style>
    .payment-detail-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .detail-card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }
    
    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }
    
    .detail-value {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
    }
    
    .amount-highlight {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
        padding: 32px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
    }
    
    .amount-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        margin-bottom: 12px;
        display: block;
    }
    
    .amount-value {
        font-size: 48px;
        font-weight: 800;
        margin: 8px 0;
    }
    
    .amount-status {
        font-size: 13px;
        margin-top: 12px;
        opacity: 0.95;
    }
    
    .info-section {
        margin-bottom: 8px;
        padding-bottom: 8px;
    }
    
    .color-border-left {
        border-left: 4px solid #10b981;
        padding-left: 20px;
    }
    
    .color-border-blue {
        border-left: 4px solid #3b82f6;
        padding-left: 20px;
    }
    
    .color-border-purple {
        border-left: 4px solid #8b5cf6;
        padding-left: 20px;
    }
    
    .color-border-orange {
        border-left: 4px solid #f97316;
        padding-left: 20px;
    }
    
    .receipt-sidebar {
        position: sticky;
        top: 20px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
        padding: 28px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
    }
    
    .receipt-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .receipt-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .receipt-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
        margin-bottom: 6px;
        display: block;
    }
    
    .receipt-value {
        font-size: 15px;
        font-weight: 700;
        word-break: break-all;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f3f4f6;
        color: #374151;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-back:hover {
        background: #e5e7eb;
        transform: translateX(-4px);
    }
    
    .btn-print {
        display: block;
        width: 100%;
        text-align: center;
        background: #fff;
        color: #10b981;
        padding: 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        margin-top: 16px;
        font-size: 15px;
    }
    
    .btn-print:hover {
        background: #f0fdf4;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    
    .no-receipt {
        background: #fffbeb;
        color: #92400e;
        padding: 20px;
        border-radius: 8px;
        border: 2px solid #fcd34d;
    }
</style>

<div class="payment-detail-container">
    <!-- Header -->
    <div style="margin-bottom: 32px;">
        <div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:32px;color:#fff;box-shadow:0 4px 12px rgba(16,185,129,0.15)">
            <h1 style="margin:0;font-size:32px;font-weight:700">💳 Détails du Paiement</h1>
            <p style="margin:8px 0 0;opacity:0.9;font-size:16px">Récapitulatif complet du paiement</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 380px; gap: 24px; align-items: start;">
        <!-- Main Content -->
        <div>
            <!-- Student Information -->
            <div class="detail-card color-border-left">
                <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 700; color: #1f2937;">👤 Informations de l'Étudiant</h3>
                <div class="detail-grid">
                    <div class="info-section">
                        <span class="detail-label">Nom Complet</span>
                        <span class="detail-value">{{ $payment->student->full_name }}</span>
                    </div>
                    <div class="info-section">
                        <span class="detail-label">Matricule</span>
                        <span class="detail-value" style="font-family: monospace; color: #10b981;">{{ $payment->student->registration_number }}</span>
                    </div>
                </div>
            </div>

            <!-- Montant Principal -->
            <div class="amount-highlight">
                <span class="amount-label">💰 Montant du Paiement</span>
                <div class="amount-value">{{ number_format($payment->amount, 0) }}<span style="font-size: 24px; margin-left: 8px;">FCFA</span></div>
                <span class="amount-status">✓ Paiement Confirmé</span>
            </div>

            <!-- Details Grid -->
            <div class="detail-grid">
                <!-- Type de Frais -->
                <div class="detail-card color-border-blue">
                    <span class="detail-label">📚 Type de Frais</span>
                    <span class="detail-value">{{ $payment->feeType->name ?? 'N/A' }}</span>
                </div>

                <!-- Année Académique -->
                <div class="detail-card color-border-purple">
                    <span class="detail-label">📅 Année Académique</span>
                    <span class="detail-value">{{ $payment->academicYear->label ?? 'N/A' }}</span>
                </div>

                <!-- Mode de Paiement -->
                <div class="detail-card color-border-orange">
                    <span class="detail-label">💳 Mode de Paiement</span>
                    <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $payment->payment_mode ?? 'N/A')) }}</span>
                </div>

                <!-- Date du Paiement -->
                <div class="detail-card color-border-left">
                    <span class="detail-label">📆 Date du Paiement</span>
                    @php
                        $createdDate = is_string($payment->created_at) ? \Carbon\Carbon::parse($payment->created_at) : $payment->created_at;
                    @endphp
                    <span class="detail-value">{{ $createdDate->format('d/m/Y') }}</span>
                    <span style="font-size: 13px; color: #6b7280; display: block; margin-top: 4px;">À {{ $createdDate->format('H:i') }}</span>
                </div>
            </div>

            <!-- Référence (if exists) -->
            @if($payment->reference)
            <div class="detail-card" style="border-left: 4px solid #3b82f6; padding-left: 20px;">
                <span class="detail-label">🔗 Référence de Paiement</span>
                <span class="detail-value" style="font-family: monospace; word-break: break-all; display: block; background: #f3f4f6; padding: 12px; border-radius: 6px; margin-top: 8px;">{{ $payment->reference }}</span>
            </div>
            @endif

            <!-- Notes (if exists) -->
            @if($payment->notes)
            <div class="detail-card" style="border-left: 4px solid #f97316; padding-left: 20px;">
                <span class="detail-label">📝 Remarques</span>
                <p style="margin: 8px 0 0 0; font-size: 15px; color: #374151; line-height: 1.6;">{{ $payment->notes }}</p>
            </div>
            @endif

            <!-- Traité par -->
            <div class="detail-card color-border-purple">
                <span class="detail-label">✅ Traité par</span>
                <span class="detail-value">{{ $payment->processedBy->name ?? 'Non spécifié' }}</span>
            </div>
        </div>

        <!-- Receipt Sidebar -->
        <div>
            @if($payment->receipt)
            <div class="receipt-sidebar">
                <div class="receipt-title">
                    🧾 Reçu de Paiement
                </div>
                
                <div class="receipt-item">
                    <span class="receipt-label">Numéro de Reçu</span>
                    <span class="receipt-value" style="font-size: 18px;">{{ $payment->receipt->receipt_number }}</span>
                </div>

                <div class="receipt-item">
                    <span class="receipt-label">Impressions</span>
                    <span class="receipt-value">{{ $payment->receipt->print_count ?? 0 }} fois</span>
                </div>

                <div class="receipt-item">
                    <span class="receipt-label">Créé le</span>
                    @php
                        $receiptCreated = is_string($payment->receipt->created_at) ? \Carbon\Carbon::parse($payment->receipt->created_at) : $payment->receipt->created_at;
                    @endphp
                    <span class="receipt-value">{{ $receiptCreated->format('d/m/Y') }}</span>
                    <span style="font-size: 12px; opacity: 0.9; display: block; margin-top: 4px;">À {{ $receiptCreated->format('H:i') }}</span>
                </div>

                @if($payment->receipt->printed_at)
                <div class="receipt-item">
                    <span class="receipt-label">Dernière Impression</span>
                    @php
                        $printedAt = is_string($payment->receipt->printed_at) ? \Carbon\Carbon::parse($payment->receipt->printed_at) : $payment->receipt->printed_at;
                    @endphp
                    <span class="receipt-value">{{ $printedAt->format('d/m/Y') }}</span>
                    <span style="font-size: 12px; opacity: 0.9; display: block; margin-top: 4px;">À {{ $printedAt->format('H:i') }}</span>
                </div>
                @endif

                <a href="{{ route('receipts.print', $payment->receipt) }}" 
                   class="btn-print"
                   target="_blank">
                    🖨️ Imprimer le Reçu
                </a>
            </div>
            @else
            <div class="no-receipt">
                <h3 style="margin: 0 0 12px 0; font-size: 16px; font-weight: 700;">⚠️ Reçu</h3>
                <p style="margin: 0 0 8px 0; font-size: 14px;">Aucun reçu n'a encore été généré pour ce paiement.</p>
                <p style="margin: 0; font-size: 13px; opacity: 0.85;">Un reçu peut être généré après l'enregistrement du paiement.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Back Button -->
    <div style="margin-top: 32px;">
        <a href="{{ route('payments.index') }}" class="btn-back">
            ← Retour à la liste
        </a>
    </div>
</div>
@endsection
