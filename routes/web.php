<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $contracts = \App\Models\Contract::query();

    // Contagem por status
    $activeCount = \App\Models\Contract::where('status', 'Ativo')->count();
    $pendingCount = \App\Models\Contract::whereIn('status', ['Pendente', 'Em Análise'])->count();
    $completedCount = \App\Models\Contract::where('status', 'Encerrado')->count();

    // Contratos vencendo em 30 dias
    $expiringCount = \App\Models\Contract::where('status', 'Ativo')
        ->whereBetween('end_date', [now(), now()->addDays(30)])
        ->count();

    // Contratos recentes
    $recentContracts = \App\Models\Contract::with(['supplier', 'contractType'])
        ->latest()
        ->take(5)
        ->get();

    // Dados para os gráficos
    $statusData = [
        'active' => $activeCount,
        'pending' => $pendingCount,
        'completed' => $completedCount,
        'expired' => $expiringCount,
    ];

    // Dados de timeline (últimos 6 meses)
    $timelineLabels = [];
    $timelineData = [];
    for ($i = 5; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $timelineLabels[] = $date->translatedFormat('M');
        $timelineData[] = \App\Models\Contract::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count();
    }

    // Dados por tipo de contrato
    $typeStats = \App\Models\ContractType::withCount('contracts')
        ->orderByDesc('contracts_count')
        ->take(5)
        ->get();
    $typeLabels = $typeStats->pluck('name')->toArray();
    $typeData = $typeStats->pluck('contracts_count')->toArray();

    return Inertia::render('Dashboard', [
        'stats' => [
            'active' => $activeCount,
            'pending' => $pendingCount,
            'completed' => $completedCount,
            'expiring' => $expiringCount,
            'total' => \App\Models\Contract::count(),
        ],
        'recentContracts' => $recentContracts,
        'statusData' => $statusData,
        'timelineLabels' => $timelineLabels,
        'timelineData' => $timelineData,
        'typeLabels' => $typeLabels ?: ['Sem dados'],
        'typeData' => $typeData ?: [0],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Contract routes
    Route::get('/contratos/novo', [App\Http\Controllers\ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contratos', [App\Http\Controllers\ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contratos', [App\Http\Controllers\ContractController::class, 'index'])->name('contracts.index');
    Route::get('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'show'])->name('contracts.show');
    Route::get('/contratos/{contract}/editar', [App\Http\Controllers\ContractController::class, 'edit'])->name('contracts.edit');
    Route::patch('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/contratos/{contract}', [App\Http\Controllers\ContractController::class, 'destroy'])->name('contracts.destroy');

    // Contract Files routes
    Route::post('/contratos/{contract}/arquivos', [App\Http\Controllers\ContractFileController::class, 'store'])->name('contract-files.store');
    Route::get('/contratos/arquivos/{file}/download', [App\Http\Controllers\ContractFileController::class, 'download'])->name('contract-files.download');
    Route::delete('/contratos/arquivos/{file}', [App\Http\Controllers\ContractFileController::class, 'destroy'])->name('contract-files.destroy');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
