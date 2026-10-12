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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // Matricule unique saisi manuellement
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('photo')->nullable();
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->softDeletes();
            $table->timestamps();

            $table->index('registration_number');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
