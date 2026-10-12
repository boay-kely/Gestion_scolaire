@extends('layouts.guest')

@section('title', 'Politique de Confidentialité - Gestion d\'Écolage')

@section('content')
<div class="terms-container">
    <div class="terms-content">
        <button onclick="goBack()" class="btn-back">← Retour</button>
        
        <h1 class="terms-title">🔒 Politique de Confidentialité</h1>
        <p class="terms-meta">Dernière mise à jour : {{ now()->format('d/m/Y') }}</p>

        <section class="terms-section">
            <h2>1. Introduction</h2>
            <p>
                Gestion d'Écolage (ci-après "nous", "notre" ou "l'Application") s'engage à protéger votre vie privée. 
                Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos données personnelles.
            </p>
        </section>

        <section class="terms-section">
            <h2>2. Informations que Nous Collectons</h2>
            <p>
                Nous collectons les types d'informations suivants :
            </p>
            <ul class="terms-list">
                <li><strong>Informations de Compte :</strong> Nom, adresse email, mot de passe (haché)</li>
                <li><strong>Informations Étudiants :</strong> Nom, date de naissance, photo, lieu de naissance</li>
                <li><strong>Informations de Paiement :</strong> Montants, dates, méthodes de paiement</li>
                <li><strong>Données de Navigation :</strong> Adresse IP, type de navigateur, pages visitées</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>3. Comment Nous Utilisons Vos Données</h2>
            <p>
                Vos données personnelles sont utilisées pour :
            </p>
            <ul class="terms-list">
                <li>Fournir et améliorer l'Application</li>
                <li>Gérer votre compte utilisateur</li>
                <li>Traiter les paiements et générer les reçus</li>
                <li>Envoyer des notifications importantes</li>
                <li>Assurer la sécurité et prévenir la fraude</li>
                <li>Analyser l'utilisation et les performances de l'Application</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>4. Partage de Données</h2>
            <p>
                Nous ne partageons pas vos données personnelles avec des tiers, sauf :
            </p>
            <ul class="terms-list">
                <li>Avec votre consentement explicite</li>
                <li>Pour respecter la loi ou une ordonnance judiciaire</li>
                <li>Pour protéger nos droits et votre sécurité</li>
                <li>Avec les administrateurs autorisés de votre établissement</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>5. Sécurité des Données</h2>
            <p>
                Nous mettons en place des mesures de sécurité pour protéger vos données contre :
            </p>
            <ul class="terms-list">
                <li>L'accès non autorisé</li>
                <li>La modification ou la destruction illégale</li>
                <li>La divulgation accidentelle</li>
            </ul>
            <p>
                Ces mesures incluent :
            </p>
            <ul class="terms-list">
                <li>Le hachage des mots de passe</li>
                <li>Les connexions chiffrées (HTTPS)</li>
                <li>Les contrôles d'accès basés sur les rôles</li>
                <li>Les sauvegardes régulières</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>6. Durée de Rétention</h2>
            <p>
                Vos données sont conservées pendant la durée de votre compte. Vous pouvez demander la suppression 
                de vos données à tout moment, sauf si la loi exige que nous les conservions plus longtemps.
            </p>
        </section>

        <section class="terms-section">
            <h2>7. Vos Droits</h2>
            <p>
                Vous avez le droit de :
            </p>
            <ul class="terms-list">
                <li>Accéder à vos données personnelles</li>
                <li>Corriger les données inexactes</li>
                <li>Demander la suppression de vos données</li>
                <li>Limiter le traitement de vos données</li>
                <li>Recevoir vos données dans un format portable</li>
                <li>Vous opposer au traitement de vos données</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>8. Cookies et Technologie de Suivi</h2>
            <p>
                L'Application utilise des cookies pour :
            </p>
            <ul class="terms-list">
                <li>Mémoriser vos préférences</li>
                <li>Maintenir votre session de connexion</li>
                <li>Analyser l'utilisation de l'Application</li>
                <li>Améliorer votre expérience utilisateur</li>
            </ul>
            <p>
                Vous pouvez contrôler les cookies via les paramètres de votre navigateur.
            </p>
        </section>

        <section class="terms-section">
            <h2>9. Liens Externes</h2>
            <p>
                L'Application peut contenir des liens vers des sites externes. Nous ne sommes pas responsables 
                de leurs politiques de confidentialité. Veuillez consulter leur politique de confidentialité 
                avant de partager vos données personnelles.
            </p>
        </section>

        <section class="terms-section">
            <h2>10. Enfants</h2>
            <p>
                L'Application n'est pas destinée aux enfants de moins de 13 ans. Nous ne collectons 
                pas intentionnellement de données personnelles d'enfants. Si vous avez connaissance 
                qu'un enfant utilise l'Application, veuillez nous contacter immédiatement.
            </p>
        </section>

        <section class="terms-section">
            <h2>11. Modifications de la Politique</h2>
            <p>
                Nous pouvons modifier cette politique de confidentialité à tout moment. Les modifications 
                seront publiées sur cette page avec la date de mise à jour. L'utilisation continue de 
                l'Application après les modifications constitue votre acceptation des changements.
            </p>
        </section>

        <section class="terms-section">
            <h2>12. Conformité Légale</h2>
            <p>
                Nous nous efforçons de nous conformer aux lois sur la protection des données applicables, 
                y compris le RGPD (Règlement Général sur la Protection des Données) et autres législations similaires.
            </p>
        </section>

        <section class="terms-section">
            <h2>13. Nous Contacter</h2>
            <p>
                Si vous avez des questions concernant cette politique de confidentialité ou sur le traitement 
                de vos données personnelles, veuillez nous contacter :
            </p>
            <ul class="terms-list">
                <li>📧 Email : privacy@gestion-ecolage.com</li>
                <li>📞 Téléphone : +1 (XXX) XXX-XXXX</li>
                <li>📍 Adresse : [Votre Adresse Ici]</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>14. Responsable de la Protection des Données</h2>
            <p>
                Pour les questions relatives à la protection des données, vous pouvez également contacter 
                notre Responsable de la Protection des Données (DPO) :
            </p>
            <ul class="terms-list">
                <li>📧 Email : dpo@gestion-ecolage.com</li>
            </ul>
        </section>

        <div class="terms-footer">
            <p>
                <strong>Votre confiance est importante pour nous !</strong>
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
