<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\FeeType;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Academic Years
        $currentYear = AcademicYear::firstOrCreate(
            ['label' => '2025-2026'],
            [
                'year' => 2025,
                'start_date' => '2025-09-01',
                'end_date' => '2026-08-31',
                'is_active' => true,
            ]
        );

        // Create Levels
        $levels = [
            // Primaire
            ['name' => 'CP', 'cycle' => 'primaire', 'order' => 1],
            ['name' => 'CE1', 'cycle' => 'primaire', 'order' => 2],
            ['name' => 'CE2', 'cycle' => 'primaire', 'order' => 3],
            ['name' => 'CM1', 'cycle' => 'primaire', 'order' => 4],
            ['name' => 'CM2', 'cycle' => 'primaire', 'order' => 5],
            // Secondaire
            ['name' => '6ème', 'cycle' => 'secondaire', 'order' => 6],
            ['name' => '5ème', 'cycle' => 'secondaire', 'order' => 7],
            ['name' => '4ème', 'cycle' => 'secondaire', 'order' => 8],
            ['name' => '3ème', 'cycle' => 'secondaire', 'order' => 9],
            // Lycée
            ['name' => 'Seconde', 'cycle' => 'lycee', 'order' => 10],
            ['name' => 'Première', 'cycle' => 'lycee', 'order' => 11],
            ['name' => 'Terminale', 'cycle' => 'lycee', 'order' => 12],
        ];

        foreach ($levels as $level) {
            Level::firstOrCreate(['name' => $level['name']], $level);
        }

        // Create Fee Types
        $feeTypes = [
            ['name' => 'Scolarité', 'description' => 'Frais de scolarité annuel'],
            ['name' => 'Inscription', 'description' => 'Frais d\'inscription'],
            ['name' => 'Assurance', 'description' => 'Assurance scolaire'],
            ['name' => 'Uniforme', 'description' => 'Uniforme scolaire'],
            ['name' => 'Fournitures', 'description' => 'Fournitures scolaires'],
        ];

        foreach ($feeTypes as $type) {
            FeeType::firstOrCreate(['name' => $type['name']], $type);
        }

        // Create Admin User
        $adminRole = Role::where('name', 'Admin')->first();
        User::firstOrCreate(
            ['email' => 'admin@ecole.com'],
            [
                'name' => 'Administrateur',
                'password' => bcrypt('admin123'),
                'role_id' => $adminRole->id,
            ]
        );

        // Create Secretary User
        $secretaryRole = Role::where('name', 'Secrétaire')->first();
        User::firstOrCreate(
            ['email' => 'secretary@ecole.com'],
            [
                'name' => 'Secrétaire École',
                'password' => bcrypt('secretary123'),
                'role_id' => $secretaryRole->id,
            ]
        );

        // Create Accountant User
        $accountantRole = Role::where('name', 'Comptable')->first();
        User::firstOrCreate(
            ['email' => 'accountant@ecole.com'],
            [
                'name' => 'Comptable École',
                'password' => bcrypt('accountant123'),
                'role_id' => $accountantRole->id,
            ]
        );

        $this->command->info('Database seeded successfully!');
    }
}
