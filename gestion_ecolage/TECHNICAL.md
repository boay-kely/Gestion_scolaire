# 📖 Documentation Technique - Modèles & Relations

## 🗂️ Modèles Eloquent et Relations

### 1. **Role**
```php
class Role extends Model {
    hasMany(User)
}
```
- Rôles: Admin, Secrétaire, Comptable, Parent

### 2. **User**
```php
class User extends Authenticatable {
    belongsTo(Role)
    hasMany(Student, 'created_by')  // Étudiants créés
    hasMany(Student, 'parent_id')    // Étudiants en tant que parent
    hasMany(Payment, 'processed_by') // Paiements traités
}
```

### 3. **Student**
```php
class Student extends Model {
    use SoftDeletes;
    
    belongsTo(Classroom)
    belongsTo(User, 'parent_id')  // Parent/tuteur
    belongsTo(User, 'created_by') // Créé par
    hasMany(Payment)
    hasMany(Discount)
    hasMany(Receipt)
}
```

**Validation du Matricule**:
- Rule: `UniqueRegistrationNumber`
- Format: String unique saisi manuellement
- Validation temps réel sur les formulaires

### 4. **Classroom**
```php
class Classroom extends Model {
    belongsTo(Level)
    belongsTo(AcademicYear)
    hasMany(Student)
}
```

### 5. **Level**
```php
class Level extends Model {
    hasMany(Classroom)
    hasMany(Tariff)
    hasMany(PaymentSchedule)
}
```

**Cycles**:
- `primaire`: CP, CE1, CE2, CM1, CM2
- `secondaire`: 6ème, 5ème, 4ème, 3ème
- `lycee`: Seconde, Première, Terminale

### 6. **AcademicYear**
```php
class AcademicYear extends Model {
    hasMany(Classroom)
    hasMany(Tariff)
    hasMany(PaymentSchedule)
    hasMany(Payment)
}
```

### 7. **FeeType**
```php
class FeeType extends Model {
    hasMany(Tariff)
    hasMany(Payment)
    hasMany(Discount)
}
```

**Types de Frais**:
- Scolarité
- Inscription
- Assurance
- Uniforme
- Fournitures

### 8. **Tariff**
```php
class Tariff extends Model {
    belongsTo(FeeType)
    belongsTo(Level)
    belongsTo(AcademicYear)
}
```

**Caractéristiques**:
- Montant décimal (10,2)
- Cycle: primaire/secondaire/lycee
- Unique par FeeType/Level/AcademicYear

### 9. **Discount**
```php
class Discount extends Model {
    belongsTo(Student)
    belongsTo(FeeType)
}
```

**Paramètres**:
- Pourcentage (0-100)
- Motif (texte)
- Validité: valid_from à valid_to

### 10. **PaymentSchedule**
```php
class PaymentSchedule extends Model {
    belongsTo(Level)
    belongsTo(AcademicYear)
}
```

**Exemple**:
```
Tranche 1: 30/09 - 30%
Tranche 2: 31/12 - 30%
Tranche 3: 31/03 - 40%
```

### 11. **Payment**
```php
class Payment extends Model {
    belongsTo(Student)
    belongsTo(FeeType)
    belongsTo(User, 'processed_by')
    belongsTo(AcademicYear)
    hasOne(Receipt)
}
```

**Modes de Paiement**:
- cash (Espèces)
- check (Chèque)
- transfer (Virement)
- mobile_money (Mobile Money)

### 12. **Receipt**
```php
class Receipt extends Model {
    belongsTo(Payment)
}
```

**Format de Numéro**: `REC-YYYY-NNN`
- Exemple: `REC-2026-001`

---

## 🛣️ Routes & Contrôleurs

### StudentController
```
GET    /students              - Liste des étudiants
GET    /students/create       - Formulaire création
POST   /students              - Créer étudiant
GET    /students/{id}         - Détail étudiant
GET    /students/{id}/edit    - Formulaire édition
PUT    /students/{id}         - Mettre à jour
DELETE /students/{id}         - Supprimer
```

### ClassroomController
```
GET    /classrooms            - Liste des classes
GET    /classrooms/create     - Créer classe
POST   /classrooms            - Sauvegarder
GET    /classrooms/{id}       - Détail classe
GET    /classrooms/{id}/edit  - Éditer classe
PUT    /classrooms/{id}       - Mettre à jour
DELETE /classrooms/{id}       - Supprimer
```

### PaymentController
```
GET    /payments              - Tableau de suivi
GET    /payments/create       - Enregistrer paiement
POST   /payments              - Sauvegarder
GET    /payments/{id}         - Détail paiement
GET    /receipts/{id}/print   - Imprimer reçu
```

---

## 🎯 Cas d'Usage Principaux

### 1. Créer un Étudiant
1. Secrétaire accède à /students/create
2. Remplit le formulaire (matricule obligatoire)
3. Sélectionne la classe et le parent
4. Soumet le formulaire
5. Rule `UniqueRegistrationNumber` vérifie l'unicité
6. Étudiant créé avec `created_by` = secrétaire

### 2. Enregistrer un Paiement
1. Comptable accède à /payments/create
2. Sélectionne étudiant, type de frais, montant
3. Choisit mode de paiement et année académique
4. Soumet le formulaire
5. Paiement créé avec `processed_by` = comptable
6. Reçu généré automatiquement avec numéro unique
7. Comptable imprime le reçu

### 3. Consulter Profil Étudiant
1. Parent/Admin accède à /students/{id}
2. Voir fiche profil en card-based design
3. Voir photo, infos, paiements et remises
4. Lien vers liste des paiements

---

## 🔍 Filtres & Recherches

### Recherche Étudiants
- Par matricule
- Par nom (first_name ou last_name)
- Par classe
- Par cycle

### Filtrage Paiements
- Par étudiant
- Par type de frais
- Par date
- Par mode de paiement
- Par année académique

---

## ⚙️ Configurations Importantes

### Fichiers de Config
- `config/database.php` - Connexion MySQL
- `config/auth.php` - Authentification Laravel
- `config/sanctum.php` - Gestion des tokens

### Middlewares
- `auth` - Authentification requise
- `verified` - Email vérifié (optionnel)
- Custom middleware pour vérifier les rôles

---

## 📊 Statistiques & Rapports

### Dashboard
- Total étudiants
- Total classes
- Paiements ce mois
- Utilisateurs
- Distribution par cycle

### Possible d'ajouter:
- Rapport de paiements par mois
- Statistiques de recouvrement
- Analyse des remises
- Suivi de présence

---

## 🐛 Débogage

### Logs
- Fichier: `storage/logs/laravel.log`
- Niveau: DEBUG en développement

### Commandes Utiles
```bash
php artisan tinker                    # Shell interactif
php artisan migrate:rollback          # Annuler migrations
php artisan db:seed                   # Relancer seeders
php artisan cache:clear               # Vider cache
php artisan route:list               # Afficher routes
```

---

## 🔄 Cycle de Vie d'un Paiement

```
1. Création du paiement
   ↓
2. Génération du reçu (numéro unique)
   ↓
3. Stockage en base de données
   ↓
4. Affichage dans tableau de suivi
   ↓
5. Impression du reçu (print_count++)
   ↓
6. Archivage/historique
```

---

*Documentation mise à jour: Mai 2026*
