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
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_type_id')->constrained('fee_types')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('cycle', ['primaire', 'secondaire', 'lycee']);
            $table->timestamps();

            $table->unique(['fee_type_id', 'level_id', 'academic_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariffs');
    }
};
