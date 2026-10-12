@extends('layouts.guest')

@section('title', 'Inscription - Gestion d\'Écolage')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        width: 100%;
        height: 100%;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-x: hidden;
    }

    .animated-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        z-index: -1;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .float-circle {
        position: fixed;
        border-radius: 50%;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) translateX(0px); }
        50% { transform: translateY(-20px) translateX(10px); }
    }

    .circle-1 { width: 250px; height: 250px; background: #fff; top: 10%; left: 8%; animation-delay: 0s; }
    .circle-2 { width: 180px; height: 180px; background: #fff; top: 65%; right: 8%; animation-delay: 2s; }
    .circle-3 { width: 120px; height: 120px; background: #fff; bottom: 15%; left: 10%; animation-delay: 4s; }

    .register-container {
        width: 450px;
        max-width: 90%;
        height: auto;
        animation: slideUp 0.8s ease-out;
        padding: 20px;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 4px;
        padding: 48px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-header {
        text-align: center;
        margin-bottom: 32px;
        animation: fadeInDown 0.8s ease-out 0.3s both;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: inline-block;
    }

    .register-title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .register-subtitle {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 20px;
        animation: fadeIn 0.6s ease-out both;
    }

    .form-group:nth-child(1) { animation-delay: 0.4s; }
    .form-group:nth-child(2) { animation-delay: 0.5s; }
    .form-group:nth-child(3) { animation-delay: 0.6s; }
    .form-group:nth-child(4) { animation-delay: 0.7s; }
    .form-group:nth-child(5) { animation-delay: 0.8s; }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        font-size: 13px;
        animation: fadeIn 0.6s ease-out 0.9s both;
    }

    .form-checkbox {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        color: #6b7280;
        gap: 8px;
    }

    .form-checkbox input {
        margin-top: 2px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .terms-text {
        flex: 1;
        line-height: 1.4;
    }

    .link-muted {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .link-muted:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .btn-submit {
        width: 100%;
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        animation: fadeIn 0.6s ease-out 1s both;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .divider {
        text-align: center;
        margin: 24px 0;
        font-size: 13px;
        color: #d1d5db;
        animation: fadeIn 0.6s ease-out 1.1s both;
    }

    .login-link {
        text-align: center;
        color: #6b7280;
        font-size: 14px;
        animation: fadeIn 0.6s ease-out 1.2s both;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-link a:hover {
        color: #764ba2;
    }

    .footer-links {
        text-align: center;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.6s ease-out 1.3s both;
    }

    .footer-link {
        color: #1f2937;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-link:hover {
        color: #000;
        text-decoration: underline;
    }

    .footer-link-separator {
        color: #9ca3af;
        margin: 0 8px;
        font-size: 12px;
    }

    .alert {
        background: #fee2e2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        color: #991b1b;
        font-size: 13px;
        animation: slideInDown 0.4s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        margin-bottom: 4px;
    }

    /* Desktop Optimizations */
    @media (min-width: 769px) {
        .register-container {
            width: 450px;
            max-width: 90%;
        }

        .register-card {
            padding: 56px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .register-icon {
            font-size: 52px;
        }

        .register-title {
            font-size: 32px;
        }

        .register-subtitle {
            font-size: 15px;
        }

        .form-label {
            font-size: 14px;
        }

        .form-input {
            padding: 14px 18px;
            font-size: 15px;
        }

        .btn-submit {
            padding: 14px 28px;
            font-size: 16px;
        }
    }

    /* Tablet */
    @media (max-width: 768px) and (min-width: 481px) {
        .register-container {
            width: 450px;
            max-width: 90%;
        }

        .register-card {
            padding: 40px 30px;
        }

        .register-icon {
            font-size: 44px;
        }

        .register-title {
            font-size: 26px;
        }

        .form-input {
            padding: 12px 15px;
        }

        .circle-1 { width: 200px; height: 200px; top: 8%; left: 5%; }
        .circle-2 { width: 150px; height: 150px; top: 65%; right: 5%; }
        .circle-3 { display: none; }
    }

    /* Mobile */
    @media (max-width: 480px) {
        .register-container {
            width: 450px;
            max-width: 90%;
            padding: 10px;
        }

        .register-card {
            padding: 30px 20px;
            border-radius: 4px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .register-title {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .register-subtitle {
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 13px;
            margin-bottom: 6px;
        }

        .form-input {
            padding: 11px 14px;
            font-size: 14px;
            border-radius: 6px;
        }

        .form-row {
            margin-bottom: 18px;
            font-size: 12px;
            flex-direction: column;
            gap: 4px;
        }

        .terms-text {
            font-size: 12px;
            line-height: 1.3;
        }

        .btn-submit {
            padding: 11px 20px;
            font-size: 14px;
        }

        .divider {
            margin: 18px 0;
            font-size: 12px;
        }

        .login-link {
            font-size: 13px;
        }

        .footer-links {
            margin-top: 16px;
            padding-top: 12px;
            gap: 4px;
        }

        .footer-link {
            font-size: 11px;
        }

        .circle-1 { width: 150px; height: 150px; top: 5%; left: 2%; }
        .circle-2 { width: 120px; height: 120px; top: 70%; right: 2%; }
        .circle-3 { display: none; }
    }

    /* Ultra-wide desktop */
    @media (min-width: 1921px) {
        .register-card {
            padding: 64px;
        }

        .register-icon {
            font-size: 56px;
        }

        .register-title {
            font-size: 36px;
        }

        .form-input {
            padding: 16px 20px;
            font-size: 16px;
        }
    }
</style>

<div class="animated-bg"></div>
<div class="float-circle circle-1"></div>
<div class="float-circle circle-2"></div>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <div class="register-icon">📝</div>
            <h1 class="register-title">Créer un compte</h1>
            <p class="register-subtitle">Rejoignez notre plateforme de gestion d'écolage</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">👤 Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-input" placeholder="Jean Dupont">
            </div>

            <div class="form-group">
                <label class="form-label">📧 Adresse e-mail</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="votremail@ecole.com">
            </div>

            <div class="form-group">
                <label class="form-label">🔑 Mot de passe</label>
                <input type="password" name="password" required class="form-input" placeholder="Minimum 8 caractères">
            </div>

            <div class="form-group">
                <label class="form-label">🔑 Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required class="form-input" placeholder="Confirmez le mot de passe">
            </div>

            <div class="form-row">
                <label class="form-checkbox">
                    <input type="checkbox" name="terms" required>
                    <span class="terms-text">J'accepte les <a href="{{ route('terms-of-use') }}" class="link-muted" target="_blank">conditions d'utilisation</a></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>

        <div class="divider">━━━━━━━━━━━━━━━━━━━━━━</div>

        <div class="login-link">
            Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </div>

        <div class="footer-links">
            <a href="{{ route('terms-of-use') }}" class="footer-link">📋 Conditions d'utilisation</a>
            <span class="footer-link-separator">•</span>
            <a href="{{ route('privacy-policy') }}" class="footer-link">🔒 Politique de confidentialité</a>
        </div>
    </div>
</div>

@endsection
