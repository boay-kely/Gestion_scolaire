<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Gestion d\'Écolage'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial;}</style>
    <script defer src="<?php echo e(asset('js/main.js')); ?>"></script>
</head>
<body class="app-body sidebar-expanded <?php if(Route::is('students.*')): ?> theme-students <?php elseif(Route::is('parents.*')): ?> theme-parents <?php elseif(Route::is('classrooms.*')): ?> theme-classrooms <?php elseif(Route::is('payments.*')): ?> theme-payments <?php endif; ?>">
    <div class="app-root">
        <!-- Sidebar -->
        <aside class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo-icon">🏫</div>
                    <a href="<?php echo e(route('dashboard')); ?>" class="brand">Gestion Écolage</a>
                </div>
                <button id="toggle-sidebar" class="btn-icon" aria-label="Basculer la sidebar">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>

            <nav class="app-nav">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-item <?php if(Route::is('dashboard')): ?> active <?php endif; ?>"><span class="icon">📊</span><span class="label">Tableau de bord</span></a>
                <a href="<?php echo e(route('students.index')); ?>" class="nav-item <?php if(Route::is('students.*')): ?> active <?php endif; ?>"><span class="icon">👥</span><span class="label">Étudiants</span></a>
                <a href="<?php echo e(route('parents.index')); ?>" class="nav-item <?php if(Route::is('parents.*')): ?> active <?php endif; ?>"><span class="icon">👨‍👩‍👧</span><span class="label">Parents</span></a>
                <a href="<?php echo e(route('classrooms.index')); ?>" class="nav-item <?php if(Route::is('classrooms.*')): ?> active <?php endif; ?>"><span class="icon">🏫</span><span class="label">Classes</span></a>
                <a href="<?php echo e(route('payments.index')); ?>" class="nav-item <?php if(Route::is('payments.*')): ?> active <?php endif; ?>"><span class="icon">💳</span><span class="label">Paiements</span></a>
            </nav>

            <!-- User Profile -->
            <div class="app-profile">
                <div class="profile-row">
                    <div class="avatar" style="overflow:hidden">
                        <?php if(Auth::user()->photo): ?>
                        <img src="<?php echo e(asset('storage/' . Auth::user()->photo)); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                             style="width:100%;height:100%;object-fit:cover">
                        <?php else: ?>
                        <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U',0,1))); ?>

                        <?php endif; ?>
                    </div>
                    <div class="profile-info"><div class="name"><?php echo e(Auth::user()->name ?? 'Utilisateur'); ?></div><div class="role"><?php echo e(Auth::user()->role?->name ?? 'N/A'); ?></div></div>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <header class="main-header">
                <div class="header-left">
                    <h1 class="page-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                    <div class="page-subtitle"><?php echo $__env->yieldContent('page-subtitle'); ?></div>
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
                            <?php if(Auth::user()->photo): ?>
                            <img src="<?php echo e(asset('storage/' . Auth::user()->photo)); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                                 style="width:100%;height:100%;object-fit:cover">
                            <?php else: ?>
                            <span class="profile-avatar"><?php echo e(strtoupper(substr(Auth::user()->name ?? 'U',0,1))); ?></span>
                            <?php endif; ?>
                        </button>
                        <div class="dropdown-menu" id="profile-dropdown">
                            <div class="dropdown-header">
                                <div class="user-name"><?php echo e(Auth::user()->name); ?></div>
                                <div class="user-email"><?php echo e(Auth::user()->email); ?></div>
                            </div>
                            <hr style="margin:8px 0;border:none;border-top:1px solid #e5e7eb">
                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                ⚙️ Paramètres
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="dropdown-item-form">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    🚪 Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrap">
                <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <span><?php echo e(session('success')); ?></span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">✕</button>
                </div>
                <?php endif; ?>

                <div class="page-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
<?php /**PATH F:\gestion_ecolage\gestion_ecolage\resources\views/layouts/app.blade.php ENDPATH**/ ?>