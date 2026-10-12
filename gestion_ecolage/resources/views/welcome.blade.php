@extends('layouts.guest')

@section('title', 'Bienvenue - Gestion d\'Écolage')

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
        flex-direction: column;
        overflow-x: hidden;
    }

    /* Animated Background */
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

    /* Floating elements */
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

    .circle-1 { width: 300px; height: 300px; background: #fff; top: 5%; left: 5%; animation-delay: 0s; }
    .circle-2 { width: 250px; height: 250px; background: #fff; bottom: 10%; right: 5%; animation-delay: 2s; }
    .circle-3 { width: 150px; height: 150px; background: #fff; top: 50%; right: 10%; animation-delay: 4s; display: none; }

    /* Top Navigation Bar */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        padding: 16px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar-content {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
    }

    .navbar-brand {
        font-size: 24px;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .navbar-buttons {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-nav {
        padding: 10px 24px;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-nav-login {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-nav-login:hover {
        background: rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .btn-nav-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .btn-nav-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-nav-dashboard {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .btn-nav-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    /* Main Container */
    .welcome-container {
        max-width: 1200px;
        width: 90%;
        margin: 0 auto;
        animation: slideUp 0.8s ease-out;
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

    /* Hero Section */
    .hero {
        text-align: center;
        color: white;
        margin-bottom: 60px;
        animation: fadeInDown 0.8s ease-out 0.2s both;
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

    .hero-icon {
        font-size: 80px;
        margin-bottom: 20px;
        display: inline-block;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .hero-title {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .hero-title span {
        color: #ffd700;
        text-decoration: underline;
        text-decoration-color: rgba(255, 215, 0, 0.5);
    }

    .hero-subtitle {
        font-size: 18px;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* Buttons Container */
    .buttons-container {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-bottom: 80px;
        flex-wrap: wrap;
        animation: fadeIn 0.8s ease-out 0.4s both;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .btn {
        padding: 14px 32px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        display: inline-block;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        animation: slideInLeft 0.6s ease-out 0.5s both;
    }

    .btn-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-ghost {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
        animation: slideInRight 0.6s ease-out 0.5s both;
        backdrop-filter: blur(10px);
    }

    .btn-ghost:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(255, 255, 255, 0.3);
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeInUp 0.6s ease-out both;
    }

    .feature-card:nth-child(1) { animation-delay: 0.6s; }
    .feature-card:nth-child(2) { animation-delay: 0.8s; }
    .feature-card:nth-child(3) { animation-delay: 1s; }

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

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        font-size: 50px;
        margin-bottom: 16px;
        display: inline-block;
    }

    .feature-card:hover .feature-icon {
        animation: none;
    }

    .feature-title {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
    }

    .feature-description {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    /* Stats Section */
    .stats-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px;
        color: white;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        text-align: center;
        margin-bottom: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeIn 0.8s ease-out 1.2s both;
    }

    .stat-item {
        animation: scaleIn 0.6s ease-out both;
    }

    .stat-item:nth-child(1) { animation-delay: 1.4s; }
    .stat-item:nth-child(2) { animation-delay: 1.6s; }
    .stat-item:nth-child(3) { animation-delay: 1.8s; }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Desktop Optimizations (1920px+) */
    @media (min-width: 1921px) {
        .navbar-content {
            max-width: 1600px;
        }

        .welcome-container {
            max-width: 1400px;
        }

        .hero-title {
            font-size: 56px;
        }

        .hero-subtitle {
            font-size: 20px;
            max-width: 750px;
        }

        .hero-icon {
            font-size: 96px;
        }

        .btn {
            padding: 16px 40px;
            font-size: 17px;
        }

        .feature-card {
            padding: 48px;
        }

        .feature-icon {
            font-size: 60px;
        }

        .feature-title {
            font-size: 22px;
        }

        .stat-number {
            font-size: 42px;
        }

        .stat-label {
            font-size: 16px;
        }
    }

    /* Desktop Optimizations (1024px - 1920px) */
    @media (min-width: 1024px) and (max-width: 1920px) {
        .navbar-content {
            max-width: 1200px;
        }

        .welcome-container {
            max-width: 1200px;
        }

        .hero-title {
            font-size: 48px;
        }

        .hero-subtitle {
            font-size: 18px;
            max-width: 650px;
        }

        .hero-icon {
            font-size: 80px;
        }

        .buttons-container {
            gap: 20px;
        }

        .btn {
            padding: 14px 36px;
            font-size: 15px;
        }

        .feature-card {
            padding: 40px;
        }

        .feature-icon {
            font-size: 52px;
        }

        .feature-title {
            font-size: 20px;
        }

        .stat-number {
            font-size: 38px;
        }

        .stat-label {
            font-size: 15px;
        }

        .circle-1 { width: 280px; height: 280px; }
        .circle-2 { width: 220px; height: 220px; }
        .circle-3 { display: block; width: 140px; height: 140px; }
    }

    /* Tablet landscape (768px - 1024px) */
    @media (min-width: 769px) and (max-width: 1023px) {
        .navbar-content {
            padding: 12px 16px;
            gap: 16px;
        }

        .navbar-brand {
            font-size: 20px;
        }

        .btn-nav {
            padding: 8px 16px;
            font-size: 13px;
        }

        .welcome-container {
            width: 95%;
            padding: 20px;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-subtitle {
            font-size: 15px;
            max-width: 550px;
        }

        .hero-icon {
            font-size: 64px;
        }

        .buttons-container {
            gap: 12px;
            margin-bottom: 50px;
        }

        .btn {
            padding: 12px 28px;
            font-size: 14px;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .feature-card {
            padding: 32px;
        }

        .feature-icon {
            font-size: 44px;
        }

        .feature-title {
            font-size: 18px;
        }

        .stats-section {
            grid-template-columns: repeat(3, 1fr);
            padding: 32px;
            gap: 24px;
        }

        .stat-number {
            font-size: 32px;
        }

        .stat-label {
            font-size: 13px;
        }

        .circle-1 { width: 200px; height: 200px; top: 8%; }
        .circle-2 { width: 160px; height: 160px; bottom: 12%; }
        .circle-3 { display: none; }
    }

    /* Tablet portrait (481px - 768px) */
    @media (max-width: 768px) and (min-width: 481px) {
        .navbar {
            padding: 12px 16px;
        }

        .navbar-content {
            flex-wrap: wrap;
            padding: 12px 16px;
            gap: 16px;
        }

        .navbar-brand {
            font-size: 18px;
        }

        .btn-nav {
            padding: 8px 14px;
            font-size: 12px;
        }

        .welcome-container {
            width: 95%;
            padding: 20px;
            margin-top: 60px;
        }

        .hero {
            margin-bottom: 40px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-subtitle {
            font-size: 14px;
        }

        .hero-icon {
            font-size: 56px;
        }

        .buttons-container {
            gap: 12px;
            margin-bottom: 40px;
        }

        .btn {
            padding: 11px 24px;
            font-size: 13px;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .feature-card {
            padding: 28px;
        }

        .feature-icon {
            font-size: 40px;
        }

        .feature-title {
            font-size: 16px;
        }

        .feature-description {
            font-size: 13px;
        }

        .stats-section {
            grid-template-columns: 1fr;
            padding: 24px;
            gap: 20px;
        }

        .stat-number {
            font-size: 28px;
        }

        .stat-label {
            font-size: 12px;
        }

        .circle-1 { width: 150px; height: 150px; top: 5%; left: 2%; }
        .circle-2 { width: 120px; height: 120px; bottom: 15%; right: 2%; }
        .circle-3 { display: none; }
    }

    /* Mobile (max-width 480px) */
    @media (max-width: 480px) {
        .navbar {
            padding: 12px 12px;
        }

        .navbar-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
            padding: 8px 12px;
        }

        .navbar-brand {
            font-size: 16px;
        }

        .navbar-buttons {
            width: 100%;
            gap: 8px;
        }

        .btn-nav {
            flex: 1;
            padding: 8px 12px;
            font-size: 11px;
            text-align: center;
        }

        .welcome-container {
            width: 100%;
            padding: 12px;
            margin-top: 140px;
        }

        .hero {
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 24px;
        }

        .hero-subtitle {
            font-size: 13px;
        }

        .hero-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .buttons-container {
            gap: 10px;
            margin-bottom: 30px;
            flex-direction: column;
        }

        .btn {
            width: 100%;
            padding: 12px 20px;
            font-size: 14px;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 30px;
        }

        .feature-card {
            padding: 20px;
            border-radius: 12px;
        }

        .feature-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .feature-title {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .feature-description {
            font-size: 12px;
        }

        .stats-section {
            grid-template-columns: 1fr;
            padding: 20px;
            gap: 16px;
            margin-bottom: 30px;
            border-radius: 12px;
        }

        .stat-item {
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-number {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
        }

        .circle-1 { width: 120px; height: 120px; top: 3%; left: 1%; }
        .circle-2 { width: 100px; height: 100px; bottom: 20%; right: 1%; }
        .circle-3 { display: none; }
    }
</style>

<div class="animated-bg"></div>
<div class="float-circle circle-1"></div>
<div class="float-circle circle-2"></div>
<div class="float-circle circle-3"></div>

<!-- Top Navigation Bar -->
<nav class="navbar">
    <div class="navbar-content">
        <div class="navbar-brand">
            📚 Gestion Écolage
        </div>
        <div class="navbar-buttons">
            @guest
                <a href="{{ route('login') }}" class="btn-nav btn-nav-login">
                    🔐 Connexion
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-nav btn-nav-register">
                        ✨ S'inscrire
                    </a>
                @endif
            @else
                <a href="{{ route('dashboard') }}" class="btn-nav btn-nav-dashboard">
                    🚀 Tableau de Bord
                </a>
            @endguest
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="welcome-container">
    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-icon">📚</div>
        <h1 class="hero-title">Système de Gestion d' <span>Écolage</span></h1>
        <p class="hero-subtitle">Une plateforme complète pour gérer les étudiants, les classes, les paiements et générer des reçus officiels en toute simplicité.</p>
    </div>

    <!-- Buttons -->
    <div class="buttons-container">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">🔐 Se connecter</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-ghost">✨ Créer un compte</a>
            @endif
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-primary">🚀 Accéder au système</a>
        @endguest
    </div>

    <!-- Features -->
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">👥</div>
            <h3 class="feature-title">Gestion des Étudiants</h3>
            <p class="feature-description">Fiches complètes avec photos, historique académique et suivi des paiements en un seul endroit.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏫</div>
            <h3 class="feature-title">Organisation des Classes</h3>
            <p class="feature-description">Structure flexible par niveaux et cycles avec gestion automatique des effectifs.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💳</div>
            <h3 class="feature-title">Paiements & Reçus</h3>
            <p class="feature-description">Enregistrement sécurisé des paiements et génération instantanée de reçus officiels.</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-section">
        <div class="stat-item">
            <div class="stat-number">100+</div>
            <div class="stat-label">Écoles utilisatrices</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">10k+</div>
            <div class="stat-label">Étudiants gérés</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">99.9%</div>
            <div class="stat-label">Disponibilité</div>
        </div>
    </div>
</div>
</div>

@endsection
