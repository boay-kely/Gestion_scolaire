<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Ajouter la nouvelle colonne si elle n'existe pas
            if (!Schema::hasColumn('students', 'parent_guardian_id')) {
                $table->foreignId('parent_guardian_id')->nullable()->after('classroom_id')->constrained('parents')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'parent_guardian_id')) {
                $table->dropForeign(['parent_guardian_id']);
                $table->dropColumn('parent_guardian_id');
            }
        });
    }
};
