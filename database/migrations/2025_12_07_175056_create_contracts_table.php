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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id(); // id: INTEGER
            
            // Chaves Estrangeiras (Foreign Keys) - São a base do seu MER!
            // 1. users: fk_contracts_user_id_users
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            
            // 2. suppliers: fk_contracts_supplier_id_suppliers
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('restrict');
            
            // 3. contract_types: fk_contracts_contract_type_id_contract_types
            // Nota: Você precisará criar a migration de 'contract_types' antes desta!
            $table->foreignId('contract_type_id')->constrained('contract_types')->onDelete('restrict'); 
            
            // Colunas do Contrato
            $table->string('code', 50)->unique(); // code: VARCHAR(50), único (número do contrato)
            $table->string('title', 255); // title: VARCHAR(255)
            $table->text('description')->nullable(); // description: TEXT
            $table->string('status', 20); // status: VARCHAR(20) (Ex: 'Ativo', 'Encerrado', 'Pendente')
            $table->date('start_date'); // start_date: DATE
            $table->date('end_date'); // end_date: DATE
            $table->decimal('total', 15, 2); // total: DECIMAL(15, 2) (Valor total do contrato)

            // Colunas de Auditoria
            $table->timestamps(); // created_at, updated_at
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
