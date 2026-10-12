@extends('layouts.guest')

@section('title', 'Conditions d\'Utilisation - Gestion d\'Écolage')

@section('content')
<div class="terms-container">
    <div class="terms-content">
        <button onclick="goBack()" class="btn-back">← Retour</button>
        
        <h1 class="terms-title">📋 Conditions d'Utilisation</h1>
        <p class="terms-meta">Dernière mise à jour : {{ now()->format('d/m/Y') }}</p>

        <section class="terms-section">
            <h2>1. Acceptation des Conditions</h2>
            <p>
                En accédant et en utilisant le système de Gestion d'Écolage (ci-après dénommé "l'Application"), 
                vous acceptez de vous conformer à ces conditions d'utilisation. Si vous n'acceptez pas ces conditions, 
                veuillez ne pas utiliser l'Application.
            </p>
        </section>

        <section class="terms-section">
            <h2>2. Description du Service</h2>
            <p>
                L'Application est un système de gestion des paiements de scolarité conçu pour les établissements 
                éducatifs. Elle permet de :
            </p>
            <ul class="terms-list">
                <li>Gérer les informations des étudiants et de leurs parents/tuteurs</li>
                <li>Enregistrer et suivre les paiements de scolarité</li>
                <li>Générer des reçus de paiement</li>
                <li>Organiser les classes et les niveaux d'études</li>
                <li>Appliquer des tarifs et des réductions</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>3. Compte Utilisateur</h2>
            <p>
                Pour accéder à l'Application, vous devez créer un compte avec des identifiants de connexion. 
                Vous êtes responsable de la confidentialité de vos identifiants et de toutes les activités 
                effectuées sous votre compte.
            </p>
            <p>
                Vous acceptez de :
            </p>
            <ul class="terms-list">
                <li>Fournir des informations exactes et à jour lors de l'inscription</li>
                <li>Notifier immédiatement les administrateurs de tout accès non autorisé</li>
                <li>Ne pas partager vos identifiants avec d'autres utilisateurs</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>4. Droits d'Utilisation</h2>
            <p>
                Vous accordez à Gestion d'Écolage une licence limitée, non exclusive et révocable pour utiliser 
                l'Application conformément à ces conditions.
            </p>
            <p>
                Vous vous engagez à :
            </p>
            <ul class="terms-list">
                <li>Utiliser l'Application uniquement à des fins légales et autorisées</li>
                <li>Ne pas tenter d'accéder à des parties non autorisées de l'Application</li>
                <li>Ne pas modifier, adapter ou créer des travaux dérivés de l'Application</li>
                <li>Ne pas partager les données confidentielles avec des tiers</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>5. Propriété Intellectuelle</h2>
            <p>
                L'Application, son interface, ses fonctionnalités et tout contenu fourni par Gestion d'Écolage 
                sont la propriété exclusive de Gestion d'Écolage ou de ses concédants. Aucune partie ne peut être 
                reproduite ou utilisée sans permission écrite.
            </p>
        </section>

        <section class="terms-section">
            <h2>6. Protection des Données</h2>
            <p>
                Les données personnelles et les informations de paiement sont traitées conformément à notre 
                <a href="{{ route('privacy-policy') }}" class="terms-link">Politique de Confidentialité</a>.
            </p>
            <p>
                L'Application utilise des mesures de sécurité pour protéger vos données contre l'accès non autorisé. 
                Cependant, aucune transmission de données sur Internet n'est 100% sécurisée.
            </p>
        </section>

        <section class="terms-section">
            <h2>7. Responsabilité</h2>
            <p>
                Gestion d'Écolage ne peut pas être tenu responsable de :
            </p>
            <ul class="terms-list">
                <li>Les pertes ou les dommages résultant de l'utilisation de l'Application</li>
                <li>Les interruptions de service ou les erreurs techniques</li>
                <li>Les actions des utilisateurs ou des tiers</li>
                <li>La perte de données due à une utilisation incorrecte</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>8. Limitation de Responsabilité</h2>
            <p>
                EN AUCUN CAS, GESTION D'ÉCOLAGE NE SERA RESPONSABLE DE TOUS LES DOMMAGES DIRECTS, INDIRECTS, 
                ACCIDENTELS, SPÉCIAUX OU CONSÉCUTIFS, Y COMPRIS LES PERTES DE PROFITS, LES PERTES DE DONNÉES OU 
                AUTRES DOMMAGES, MÊME SI GESTION D'ÉCOLAGE A ÉTÉ AVISÉE DE LA POSSIBILITÉ DE TELS DOMMAGES.
            </p>
        </section>

        <section class="terms-section">
            <h2>9. Paiements</h2>
            <p>
                L'Application enregistre et suit les paiements de scolarité. Vous êtes responsable de la 
                communication des informations de paiement exactes. Les reçus générés par l'Application 
                constituent une preuve du paiement.
            </p>
        </section>

        <section class="terms-section">
            <h2>10. Modifications des Conditions</h2>
            <p>
                Gestion d'Écolage se réserve le droit de modifier ces conditions d'utilisation à tout moment. 
                Les modifications seront effectives dès leur publication. L'utilisation continue de l'Application 
                après les modifications constitue l'acceptation des nouvelles conditions.
            </p>
        </section>

        <section class="terms-section">
            <h2>11. Résiliation</h2>
            <p>
                Gestion d'Écolage se réserve le droit de suspendre ou de résilier l'accès à l'Application 
                à tout moment et pour quelque raison que ce soit, notamment en cas de violation de ces conditions.
            </p>
        </section>

        <section class="terms-section">
            <h2>12. Droit Applicable</h2>
            <p>
                Ces conditions sont régies par les lois applicables. Toute dispute sera résolue selon les 
                procédures judiciaires compétentes.
            </p>
        </section>

        <section class="terms-section">
            <h2>13. Contact</h2>
            <p>
                Pour toute question concernant ces conditions d'utilisation, veuillez contacter :
            </p>
            <ul class="terms-list">
                <li>📧 Email : support@gestion-ecolage.com</li>
                <li>📞 Téléphone : +1 (XXX) XXX-XXXX</li>
            </ul>
        </section>

        <div class="terms-footer">
            <p>
                <strong>Merci d'utiliser Gestion d'Écolage !</strong>
            </p>
            <a href="{{ route('welcome') }}" class="btn-back">← Retour à l'accueil</a>
        </div>
    </div>
</div>

<style>
    .terms-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 20px;
    }

    .terms-content {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .btn-back {
        background: #f3f4f6;
        border: 2px solid #e5e7eb;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 24px;
        display: inline-block;
    }

    .btn-back:hover {
        background: #e5e7eb;
        transform: translateX(-4px);
    }

    .terms-title {
        font-size: 36px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 8px 0;
    }

    .terms-meta {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 32px 0;
    }

    .terms-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid #f3f4f6;
    }

    .terms-section:last-of-type {
        border-bottom: none;
    }

    .terms-section h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 16px 0;
    }

    .terms-section p {
        font-size: 14px;
        line-height: 1.8;
        color: #374151;
        margin: 0 0 16px 0;
    }

    .terms-list {
        margin: 12px 0 0 24px;
        padding: 0;
        list-style: disc;
    }

    .terms-list li {
        font-size: 14px;
        line-height: 1.8;
        color: #374151;
        margin-bottom: 8px;
    }

    .terms-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .terms-link:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .terms-footer {
        margin-top: 40px;
        padding-top: 32px;
        border-top: 2px solid #e5e7eb;
        text-align: center;
    }

    .terms-footer p {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .terms-content {
            padding: 24px;
        }

        .terms-title {
            font-size: 24px;
        }

        .terms-section {
            margin-bottom: 24px;
            padding-bottom: 24px;
        }

        .terms-section h2 {
            font-size: 16px;
        }
    }
</style>

<script>
function goBack() {
    if (document.referrer && document.referrer.includes(window.location.hostname)) {
        history.back();
    } else {
        window.location.href = '{{ route("welcome") }}';
    }
}
</script>
@endsection
