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
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id(); // id: INTEGER (chave primária)
            $table->string('name', 100)->unique(); // name: VARCHAR(100) - Nome do tipo de contrato
            $table->text('description')->nullable(); // description: TEXT - Descrição opcional
            
            // Colunas de Auditoria
            $table->timestamps(); // created_at, updated_at
            $table->timestamp('deleted_at')->nullable(); // Para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
    }
};
