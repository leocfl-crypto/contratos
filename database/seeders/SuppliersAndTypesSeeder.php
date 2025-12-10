<?php

namespace Database\Seeders;

use App\Models\ContractType;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SuppliersAndTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar tipos de contrato existentes
        ContractType::query()->delete();

        // Tipos de Contrato
        $contractTypes = [
            ['name' => 'Serviço', 'description' => 'Contrato de serviço'],
            ['name' => 'Bens Móveis', 'description' => 'Contrato de bens móveis'],
        ];

        foreach ($contractTypes as $type) {
            ContractType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );
        }

        // Fornecedores
        $suppliers = [
            [
                'corporate_name' => 'Tech Solutions Ltda',
                'trade_name' => 'Tech Solutions',
                'tax_id' => '12.345.678/0001-90',
                'email' => 'contato@techsolutions.com.br',
                'phone' => '(11) 3456-7890',
            ],
            [
                'corporate_name' => 'Serviços Profissionais S.A.',
                'trade_name' => 'ServiPro',
                'tax_id' => '98.765.432/0001-10',
                'email' => 'comercial@servipro.com.br',
                'phone' => '(21) 2345-6789',
            ],
            [
                'corporate_name' => 'Materiais e Suprimentos Eireli',
                'trade_name' => 'MatSupri',
                'tax_id' => '11.222.333/0001-44',
                'email' => 'vendas@matsupri.com.br',
                'phone' => '(31) 3456-7891',
            ],
            [
                'corporate_name' => 'Consultoria Empresarial Ltda',
                'trade_name' => 'ConsultEmp',
                'tax_id' => '44.555.666/0001-77',
                'email' => 'atendimento@consultemp.com.br',
                'phone' => '(41) 4567-8901',
            ],
            [
                'corporate_name' => 'Logística Express S.A.',
                'trade_name' => 'LogExpress',
                'tax_id' => '77.888.999/0001-00',
                'email' => 'operacoes@logexpress.com.br',
                'phone' => '(51) 5678-9012',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(
                ['tax_id' => $supplier['tax_id']],
                $supplier
            );
        }
    }
}
