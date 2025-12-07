<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed Contract Types
        $contractTypes = [
            ['name' => 'Prestação de Serviços', 'description' => 'Contratos de prestação de serviços gerais'],
            ['name' => 'Locação de Equipamentos', 'description' => 'Contratos de aluguel de equipamentos e maquinário'],
            ['name' => 'Consultoria', 'description' => 'Contratos de serviços de consultoria especializada'],
            ['name' => 'Manutenção', 'description' => 'Contratos de manutenção preventiva e corretiva'],
            ['name' => 'Licenciamento de Software', 'description' => 'Contratos de licença de uso de software'],
            ['name' => 'Outsourcing', 'description' => 'Contratos de terceirização de serviços'],
            ['name' => 'Fornecimento de Materiais', 'description' => 'Contratos de fornecimento de materiais e insumos'],
        ];

        foreach ($contractTypes as $type) {
            \App\Models\ContractType::create($type);
        }

        // Seed Suppliers
        $suppliers = [
            [
                'corporate_name' => 'Tech Solutions Brasil Ltda',
                'trade_name' => 'Tech Solutions',
                'tax_id' => '12.345.678/0001-90',
                'email' => 'contato@techsolutions.com.br',
                'phone' => '(11) 3456-7890',
            ],
            [
                'corporate_name' => 'Global Equipamentos S/A',
                'trade_name' => 'Global Equip',
                'tax_id' => '23.456.789/0001-01',
                'email' => 'vendas@globalequip.com.br',
                'phone' => '(11) 98765-4321',
            ],
            [
                'corporate_name' => 'Consultoria Empresarial XYZ Ltda',
                'trade_name' => 'XYZ Consultoria',
                'tax_id' => '34.567.890/0001-12',
                'email' => 'contato@xyzconsultoria.com.br',
                'phone' => '(21) 2345-6789',
            ],
            [
                'corporate_name' => 'Manutenção Industrial ABC',
                'trade_name' => 'ABC Manutenção',
                'tax_id' => '45.678.901/0001-23',
                'email' => 'atendimento@abcmanutencao.com.br',
                'phone' => '(11) 91234-5678',
            ],
            [
                'corporate_name' => 'Software House Innovations Ltda',
                'trade_name' => 'Innovations',
                'tax_id' => '56.789.012/0001-34',
                'email' => 'suporte@innovations.com.br',
                'phone' => '(48) 3210-9876',
            ],
            [
                'corporate_name' => 'Serviços Gerais Premium',
                'trade_name' => 'Premium Services',
                'tax_id' => '67.890.123/0001-45',
                'email' => 'comercial@premiumservices.com.br',
                'phone' => '(11) 92345-6789',
            ],
            [
                'corporate_name' => 'Materiais de Construção Delta',
                'trade_name' => 'Delta Materiais',
                'tax_id' => '78.901.234/0001-56',
                'email' => 'vendas@deltamateriais.com.br',
                'phone' => '(19) 3456-7890',
            ],
            [
                'corporate_name' => 'Tecnologia Avançada Ltda',
                'trade_name' => 'Tech Avançada',
                'tax_id' => '89.012.345/0001-67',
                'email' => 'contato@techavancada.com.br',
                'phone' => '(11) 93456-7890',
            ],
        ];

        foreach ($suppliers as $supplier) {
            \App\Models\Supplier::create($supplier);
        }
    }
}
