-- Script de création de la base de données pour Gestion d'Écolage
-- Compatible MariaDB/MySQL

-- Créer la base de données
CREATE DATABASE IF NOT EXISTS gestion_ecolage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_ecolage;

-- Les tables seront créées par les migrations Laravel
-- Pour exécuter les migrations:
-- php artisan migrate --seed

-- Voici le résumé des tables créées:

/*
TABLES CRÉÉES PAR LES MIGRATIONS:

1. roles
   - id (PK)
   - name (unique)
   - description
   - created_at, updated_at

2. users
   - id (PK)
   - name
   - email (unique)
   - email_verified_at
   - password
   - role_id (FK -> roles)
   - remember_token
   - created_at, updated_at

3. academic_years
   - id (PK)
   - year
   - label (unique)
   - start_date
   - end_date
   - is_active
   - created_at, updated_at

4. levels
   - id (PK)
   - name
   - cycle (enum: primaire, secondaire, lycee)
   - order
   - created_at, updated_at

5. classrooms
   - id (PK)
   - name
   - level_id (FK -> levels)
   - academic_year_id (FK -> academic_years)
   - capacity
   - created_at, updated_at
   - UNIQUE(name, level_id, academic_year_id)

6. students
   - id (PK)
   - registration_number (unique)
   - first_name
   - last_name
   - gender (M/F)
   - birth_date
   - birth_place
   - photo (nullable)
   - classroom_id (FK -> classrooms)
   - parent_id (FK -> users, nullable)
   - created_by (FK -> users)
   - deleted_at (SoftDelete)
   - created_at, updated_at
   - INDEX(registration_number, created_by)

7. fee_types
   - id (PK)
   - name
   - description (nullable)
   - created_at, updated_at

8. tariffs
   - id (PK)
   - fee_type_id (FK -> fee_types)
   - level_id (FK -> levels)
   - academic_year_id (FK -> academic_years)
   - amount (decimal 10,2)
   - cycle (enum: primaire, secondaire, lycee)
   - created_at, updated_at
   - UNIQUE(fee_type_id, level_id, academic_year_id)

9. discounts
   - id (PK)
   - student_id (FK -> students)
   - fee_type_id (FK -> fee_types)
   - percentage (decimal 5,2)
   - reason (nullable)
   - valid_from
   - valid_to (nullable)
   - created_at, updated_at

10. payment_schedules
    - id (PK)
    - level_id (FK -> levels)
    - academic_year_id (FK -> academic_years)
    - name
    - deadline
    - expected_percentage (decimal 5,2)
    - description (nullable)
    - created_at, updated_at

11. payments
    - id (PK)
    - student_id (FK -> students)
    - fee_type_id (FK -> fee_types)
    - amount (decimal 10,2)
    - payment_mode (enum: cash, check, transfer, mobile_money)
    - reference (nullable)
    - processed_by (FK -> users)
    - academic_year_id (FK -> academic_years)
    - notes (nullable)
    - created_at, updated_at
    - INDEX(student_id, fee_type_id, processed_by)

12. receipts
    - id (PK)
    - payment_id (FK -> payments)
    - receipt_number (unique)
    - print_count
    - printed_at (nullable)
    - created_at, updated_at
    - INDEX(receipt_number)

13. password_reset_tokens
    - email
    - token
    - created_at

14. failed_jobs
    - id (PK)
    - uuid (unique)
    - connection
    - queue
    - payload
    - exception
    - failed_at

15. personal_access_tokens
    - id (PK)
    - tokenable_type
    - tokenable_id
    - name
    - token (unique)
    - abilities (nullable)
    - last_used_at (nullable)
    - created_at, updated_at
*/

-- DONNÉES PAR DÉFAUT INSÉRÉES PAR LE SEEDER:
-- Rôles: Admin, Secrétaire, Comptable, Parent
-- Utilisateurs de test: admin@ecole.com, secretary@ecole.com, accountant@ecole.com
-- Niveaux d'études: CP, CE1, CE2, CM1, CM2, 6ème, 5ème, 4ème, 3ème, Seconde, Première, Terminale
-- Types de frais: Scolarité, Inscription, Assurance, Uniforme, Fournitures
-- Année académique: 2025-2026
