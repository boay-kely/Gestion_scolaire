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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('fee_type_id')->constrained('fee_types')->onDelete('restrict');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['cash', 'check', 'transfer', 'mobile_money']);
            $table->string('reference')->nullable(); // Référence de paiement
            $table->foreignId('processed_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('restrict');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['student_id', 'fee_type_id']);
            $table->index('processed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
