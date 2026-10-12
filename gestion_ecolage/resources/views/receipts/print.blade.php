<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu - {{ $receipt->receipt_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }
        .receipt {
            max-width: 650px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .receipt.duplicate::before {
            content: 'DUPLICATA';
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 8px 16px;
            font-weight: bold;
            font-size: 13px;
            border-radius: 6px;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 40px;
            color: white;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.95;
        }
        .receipt-number {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #10b981;
            margin: 24px 0;
            font-family: 'Courier New', monospace;
            background: #f0fdf4;
            padding: 12px;
            border-radius: 8px;
            margin-left: 40px;
            margin-right: 40px;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px;
        }
        .section {
            margin-bottom: 28px;
        }
        .section-title {
            font-weight: 700;
            color: #1f2937;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 12px;
            margin-bottom: 16px;
            border-bottom: 2px solid #10b981;
            display: inline-block;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .info-grid.full {
            grid-template-columns: 1fr;
        }
        .info-item {
            background: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            border-left: 3px solid #10b981;
        }
        .info-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .info-value {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
        }
        .amount-box {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 28px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 28px 0;
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2);
        }
        .amount-label {
            font-size: 16px;
            font-weight: 600;
            opacity: 0.95;
        }
        .amount-value {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .footer {
            background: #f9fafb;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            font-size: 13px;
            color: #4b5563;
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .footer-text strong {
            color: #1f2937;
        }
        .print-info {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .print-button {
                display: none;
            }
            .receipt {
                box-shadow: none;
                border-radius: 0;
            }
        }
        .print-button {
            display: block;
            text-align: center;
            margin: 30px auto 0;
            padding: 14px 32px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            max-width: 650px;
        }
        .print-button:hover {
            background: linear-gradient(135deg, #059669, #047857);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            transform: translateY(-2px);
        }
        .row-simple {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }
        .row-simple:last-child {
            border-bottom: none;
        }
        .row-label {
            color: #6b7280;
            font-weight: 500;
        }
        .row-value {
            font-weight: 700;
            color: #1f2937;
        }
    </style>
</head>
<body>
    <div class="receipt @if($receipt->print_count > 1) duplicate @endif">
        <div class="header">
            <h1>🏫 Gestion d'Écolage</h1>
            <p>Reçu de Paiement</p>
        </div>

        <div class="receipt-number">
            #{{ $receipt->receipt_number }}
        </div>

        <div class="content">
            <!-- Student Information -->
            <div class="section">
                <div class="section-title">👤 Informations Étudiant</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Nom Complet</div>
                        <div class="info-value">{{ $receipt->payment->student->full_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Matricule</div>
                        <div class="info-value">{{ $receipt->payment->student->registration_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Classe</div>
                        <div class="info-value">{{ $receipt->payment->student->classroom->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Niveau</div>
                        <div class="info-value">{{ $receipt->payment->student->classroom->level->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="section">
                <div class="section-title">💳 Détails Paiement</div>
                <div class="info-grid full">
                    <div class="row-simple">
                        <span class="row-label">Type de Frais</span>
                        <span class="row-value">{{ $receipt->payment->feeType->name }}</span>
                    </div>
                    <div class="row-simple">
                        <span class="row-label">Année Académique</span>
                        <span class="row-value">{{ $receipt->payment->academicYear->label }}</span>
                    </div>
                    <div class="row-simple">
                        <span class="row-label">Mode de Paiement</span>
                        <span class="row-value">{{ ucfirst(str_replace('_', ' ', $receipt->payment->payment_mode)) }}</span>
                    </div>
                    @if($receipt->payment->reference)
                    <div class="row-simple">
                        <span class="row-label">Référence</span>
                        <span class="row-value">{{ $receipt->payment->reference }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Amount -->
            <div class="amount-box">
                <span class="amount-label">Montant Versé</span>
                <span class="amount-value">{{ number_format($receipt->payment->amount, 2) }} FCFA</span>
            </div>

            <!-- Transaction Info -->
            <div class="section">
                <div class="section-title">📅 Informations Transaction</div>
                <div class="info-grid full">
                    <div class="row-simple">
                        <span class="row-label">Date du Paiement</span>
                        <span class="row-value">{{ $receipt->payment->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="row-simple">
                        <span class="row-label">Heure</span>
                        <span class="row-value">{{ $receipt->payment->created_at->format('H:i') }}</span>
                    </div>
                    <div class="row-simple">
                        <span class="row-label">Traité par</span>
                        <span class="row-value">{{ $receipt->payment->processedBy->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p class="footer-text">
                <strong>⚠️ IMPORTANT:</strong> Ce reçu constitue une preuve officielle de paiement. Veuillez le conserver précieusement.
            </p>
            <div class="print-info">
                Tirage #{{ $receipt->print_count }} | Imprimé le {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>
    </div>

    <button class="print-button" onclick="window.print()">🖨️ Imprimer ce Reçu</button>

    <script>
        // Auto-print on load (commented by default)
        window.addEventListener('load', function() {
            setTimeout(function() {
                // Uncomment the line below to auto-print
                // window.print();
            }, 500);
        });
    </script>
</body>
</html>
