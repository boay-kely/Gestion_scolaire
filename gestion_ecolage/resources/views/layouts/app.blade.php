<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion d\'Écolage')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial;}</style>
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>
<body class="app-body sidebar-expanded @if(Route::is('students.*')) theme-students @elseif(Route::is('parents.*')) theme-parents @elseif(Route::is('classrooms.*')) theme-classrooms @elseif(Route::is('payments.*')) theme-payments @endif">
    <div class="app-root">
        <!-- Sidebar -->
        <aside class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo-icon">🏫</div>
                    <a href="{{ route('dashboard') }}" class="brand">Gestion Écolage</a>
                </div>
                <button id="toggle-sidebar" class="btn-icon" aria-label="Basculer la sidebar">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>

            <nav class="app-nav">
                <a href="{{ route('dashboard') }}" class="nav-item @if(Route::is('dashboard')) active @endif"><span class="icon">📊</span><span class="label">Tableau de bord</span></a>
                <a href="{{ route('students.index') }}" class="nav-item @if(Route::is('students.*')) active @endif"><span class="icon">👥</span><span class="label">Étudiants</span></a>
                <a href="{{ route('parents.index') }}" class="nav-item @if(Route::is('parents.*')) active @endif"><span class="icon">👨‍👩‍👧</span><span class="label">Parents</span></a>
                <a href="{{ route('classrooms.index') }}" class="nav-item @if(Route::is('classrooms.*')) active @endif"><span class="icon">🏫</span><span class="label">Classes</span></a>
                <a href="{{ route('payments.index') }}" class="nav-item @if(Route::is('payments.*')) active @endif"><span class="icon">💳</span><span class="label">Paiements</span></a>
            </nav>

            <!-- User Profile -->
            <div class="app-profile">
                <div class="profile-row">
                    <div class="avatar" style="overflow:hidden">
                        @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                             style="width:100%;height:100%;object-fit:cover">
                        @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}
                        @endif
                    </div>
                    <div class="profile-info"><div class="name">{{ Auth::user()->name ?? 'Utilisateur' }}</div><div class="role">{{ Auth::user()->role?->name ?? 'N/A' }}</div></div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <header class="main-header">
                <div class="header-left">
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                    <div class="page-subtitle">@yield('page-subtitle')</div>
                </div>
                <div class="header-right">
                    <div class="search-wrap">
                        <input class="search-input" 
                               placeholder="🔍 Rechercher..." 
                               title="Appuyez sur Entrée pour rechercher">
                    </div>
                    <a class="support-link" href="#">Support</a>
                    
                    <!-- Profile Menu -->
                    <div class="header-menu">
                        <button class="header-profile-link" id="profile-menu-btn" title="Paramètres du profil" style="position:relative;overflow:hidden">
                            @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                                 style="width:100%;height:100%;object-fit:cover">
                            @else
                            <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu" id="profile-dropdown">
                            <div class="dropdown-header">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-email">{{ Auth::user()->email }}</div>
                            </div>
                            <hr style="margin:8px 0;border:none;border-top:1px solid #e5e7eb">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                ⚙️ Paramètres
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-item-form">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    🚪 Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrap">
                @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">✕</button>
                </div>
                @endif

                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
