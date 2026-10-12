# 🏫 Système de Gestion d'Écolage

Un système complet de gestion administrative et financière pour écoles primaires, secondaires et lycées.

## 📋 Fonctionnalités Principales

### 1. **Gestion des Étudiants**
- Création et gestion des fiches étudiants avec matricule unique
- Gestion des informations personnelles (photo, date de naissance, lieu de naissance)
- Attribution automatique aux classes par niveau et cycle
- Traçabilité des créations par le secrétaire
- SoftDelete pour archivage

### 2. **Architecture Pédagogique Multi-niveaux**
- **Primaire**: CP, CE1, CE2, CM1, CM2
- **Secondaire**: 6ème, 5ème, 4ème, 3ème
- **Lycée**: Seconde, Première, Terminale

### 3. **Gestion Financière**
- Tarification par niveau et cycle (frais différenciés primaire/secondaire/lycée)
- Types de frais: Scolarité, Inscription, Assurance, Uniforme, Fournitures
- Gestion des remises avec motif et date de validité
- Échéanciers de paiement avec tranches et pourcentages

### 4. **Paiements & Reçus**
- Enregistrement des paiements (espèces, chèques, virements, mobile money)
- Génération automatique de reçus avec numérotation unique
- Gestion des duplicatas et compteur d'impressions
- Référence de paiement personnalisée

### 5. **Contrôle d'Accès (RBAC)**
- **Admin**: Accès complet au système
- **Secrétaire**: Gestion des étudiants et classes
- **Comptable**: Gestion des paiements et reçus
- **Parent**: Accès limité à l'historique de son enfant

### 6. **Interface Utilisateur**
- Dashboard moderne et responsive
- Sidebar rétractable
- Palette couleur professionnelle (Indigo, Émeraude, Rose)
- Tableaux "Zebra-striped" avec filtrage
- Formulaires avec validation en temps réel
- Impression de reçus optimisée

## 🔧 Installation & Configuration

### Prérequis
- PHP 8.1+
- MySQL/MariaDB
- Composer
- Node.js (pour Tailwind CSS)

### Étapes d'Installation

```bash
# 1. Cloner ou extraire le projet
cd c:\xampp\htdocs\gestion_ecolage

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances Node
npm install

# 4. Configurer l'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
DB_DATABASE=gestion_ecolage
DB_USERNAME=root
DB_PASSWORD=

# 7. Exécuter les migrations et seeders
php artisan migrate --seed

# 8. Générer les assets
npm run build

# 9. Démarrer le serveur
php artisan serve
```

## 📝 Identifiants de Connexion (Données de Test)

```
Email: admin@ecole.com
Mot de passe: admin123

Email: secretary@ecole.com
Mot de passe: secretary123

Email: accountant@ecole.com
Mot de passe: accountant123
```

## 📚 Structure de la Base de Données

### Tables Principales

| Table | Description |
|-------|------------|
| `roles` | Rôles utilisateurs (Admin, Secrétaire, Comptable, Parent) |
| `users` | Utilisateurs du système |
| `students` | Fiches étudiants |
| `classrooms` | Classes par niveau et année académique |
| `levels` | Niveaux d'études avec cycle |
| `academic_years` | Années académiques |
| `fee_types` | Types de frais (Scolarité, Inscription, etc.) |
| `tariffs` | Montants par frais/niveau/année |
| `discounts` | Remises accordées aux étudiants |
| `payments` | Enregistrement des paiements |
| `payment_schedules` | Tranches de paiement |
| `receipts` | Reçus générés |

## 🔐 Sécurité

- Authentification Laravel native avec sanctum
- Autorisations basées sur les rôles
- Protection CSRF sur tous les formulaires
- Validation côté serveur et côté client
- Hachage sécurisé des mots de passe

## 🎨 Design & UX

- **Framework**: Tailwind CSS
- **Composants**: Alpine.js
- **Couleurs**:
  - 🔵 Indigo: Actions principales et primaire
  - 🟢 Émeraude: Succès et paiements
  - 🌹 Rose: Alertes et retards
  - ⚪ Gris: Contenus neutres

## 📊 Vues Principales

### Pour le Secrétaire
- Liste des étudiants avec recherche
- Création/édition de fiches
- Gestion des classes
- Dashboard avec statistiques

### Pour le Comptable
- Tableau de suivi des paiements
- Enregistrement des paiements
- Génération et impression de reçus
- Contrôle des duplicatas

### Pour l'Admin
- Accès à toutes les fonctionnalités
- Gestion des utilisateurs
- Configuration des tarifs et remises
- Rapports financiers

## 🚀 Déploiement

```bash
# Production build
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Lancer en production
php artisan serve --env=production
```

## 📞 Support

Pour toute question ou problème, veuillez contacter l'administrateur du système.

---

**Gestion d'Écolage** - Un système complet pour l'administration scolaire et financière
