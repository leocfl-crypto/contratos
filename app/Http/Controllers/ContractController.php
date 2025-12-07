<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractType;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContractController extends Controller
{
    /**
     * Display a listing of contracts.
     */
    public function index()
    {
        $contracts = Contract::with(['user', 'supplier', 'contractType'])
            ->latest()
            ->paginate(15);

        return Inertia::render('Contracts/Index', [
            'contracts' => $contracts,
        ]);
    }

    /**
     * Show the form for creating a new contract.
     */
    public function create(): Response
    {
        return Inertia::render('Contracts/Create', [
            'suppliers' => Supplier::orderBy('trade_name')->get(),
            'contractTypes' => ContractType::orderBy('name')->get(),
            'nextCode' => Contract::generateCode(),
            'statusOptions' => [
                'Ativo',
                'Pendente',
                'Em Análise',
                'Suspenso',
                'Encerrado',
            ],
        ]);
    }

    /**
     * Store a newly created contract in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'status' => 'required|string|in:Ativo,Pendente,Em Análise,Suspenso,Encerrado',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total' => 'required|numeric|min:0',
        ]);

        $contract = Contract::create([
            'code' => Contract::generateCode(),
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'supplier_id' => $validated['supplier_id'],
            'contract_type_id' => $validated['contract_type_id'],
            'status' => $validated['status'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Contrato criado com sucesso! Código: ' . $contract->code);
    }

    /**
     * Display the specified contract.
     */
    public function show(Contract $contract)
    {
        $contract->load(['user', 'supplier', 'contractType']);

        return Inertia::render('Contracts/Show', [
            'contract' => $contract,
        ]);
    }

    /**
     * Show the form for editing the specified contract.
     */
    public function edit(Contract $contract)
    {
        return Inertia::render('Contracts/Edit', [
            'contract' => $contract,
            'suppliers' => Supplier::orderBy('trade_name')->get(),
            'contractTypes' => ContractType::orderBy('name')->get(),
            'statusOptions' => [
                'Ativo',
                'Pendente',
                'Em Análise',
                'Suspenso',
                'Encerrado',
            ],
        ]);
    }

    /**
     * Update the specified contract in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'status' => 'required|string|in:Ativo,Pendente,Em Análise,Suspenso,Encerrado',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total' => 'required|numeric|min:0',
        ]);

        $contract->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Contrato atualizado com sucesso!');
    }

    /**
     * Remove the specified contract from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Contrato excluído com sucesso!');
    }
}
