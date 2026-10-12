<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Cette migration a été déplacée à 2014_10_01_000000_create_roles_table.php
    // pour s'exécuter avant la création de la table users
    
    public function up(): void
    {
        // Rien à faire - les rôles sont déjà créés
    }

    public function down(): void
    {
        // Rien à faire
    }
};

