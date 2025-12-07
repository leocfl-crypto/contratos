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
        Schema::create('suppliers', function (Blueprint $table) {
            // Colunas do MER: id, corporate_name, trade_name, tax_id, email, phone
            $table->id(); // id: INTEGER (chave primária)
            $table->string('corporate_name', 255); // corporate_name: VARCHAR(255)
            $table->string('trade_name', 255)->nullable(); // trade_name: VARCHAR(255)
            $table->string('tax_id', 20)->unique(); // tax_id: VARCHAR(20) - CNPJ/CPF, deve ser único
            $table->string('email', 100)->nullable(); // email: VARCHAR(100)
            $table->string('phone', 100)->nullable(); // phone: VARCHAR(100)
            
            // Colunas de Auditoria: created_at, updated_at, deleted_at
            $table->timestamps(); // created_at e updated_at: TIMESTAMP
            $table->timestamp('deleted_at')->nullable(); // deleted_at: TIMESTAMP (para Soft Deletes)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
