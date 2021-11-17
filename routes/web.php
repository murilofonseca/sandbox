<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Dashboard', [
        'canResetPassword' => true,
        'canManageTwoFactorAuthentication' => true,
        'hasAccountDeletionFeatures' => false
    ]);
    /*return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);*/
})->name('inicio');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

/**ROTAS COBRANÇAS */
Route::prefix('cobranca')->group(function () {
    /**ROTAS COBRANÇAS - FATURAS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/faturas', function () {
        return Inertia::render('Cobranca/Faturas');
    })->name('faturas');
    /**ROTAS COBRANÇAS - BAIXAS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/baixas', function () {
        return Inertia::render('Cobranca/Baixas');
    })->name('baixas');
});

/**ROTAS TRANSFERÊNCIAS */
Route::prefix('transferencias')->group(function () {
    /**ROTAS TRANSFERÊNCIAS - TRANSFERÊNCIAS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/transferencias', function () {
        return Inertia::render('Transferencias/Transferencias');
    })->name('transferencias');
    /**ROTAS TRANSFERÊNCIAS - LOTES */
    Route::middleware(['auth:sanctum', 'verified'])->get('/lotes', function () {
        return Inertia::render('Transferencias/Lotes');
    })->name('lotes');
});


/**ROTAS FERRAMENTAS */
Route::prefix('ferramentas')->group(function () {
    /**ROTAS FERRAMENTAS - BAIXA COBEXPRESS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/baixacobexpress', function () {
        return Inertia::render('Ferramentas/BaixaCobexpress');
    })->name('baixacobexpress');
    /**ROTAS FERRAMENTAS - CHARGEBACK */
    Route::middleware(['auth:sanctum', 'verified'])->get('/chargeback', function () {
        return Inertia::render('Ferramentas/ChargeBack');
    })->name('chargeback');
    /**ROTAS FERRAMENTAS - CONSULTAR PAGAMENTO */
    Route::middleware(['auth:sanctum', 'verified'])->get('/consultarpagamento', function () {
        return Inertia::render('Ferramentas/ConsultarPagamento');
    })->name('consultarpagamento');
    /**ROTAS FERRAMENTAS - PONTO MAIS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/pontomais', function () {
        return Inertia::render('Ferramentas/PontoMais');
    })->name('pontomais');
    /**ROTAS FERRAMENTAS - AO3 */
    Route::middleware(['auth:sanctum', 'verified'])->get('/ao3', function () {
        return Inertia::render('Ferramentas/AO3');
    })->name('ao3');
});

/**ROTAS CONFIGURAÇÕES */
Route::prefix('configuracoes')->group(function () {
    /**ROTAS CONFIGURAÇÕES - CONTAS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/contas', function () {
        return Inertia::render('Configuracoes/Contas');
    })->name('contas');
    /**ROTAS CONFIGURAÇÕES - FILIAIS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/filiais', function () {
        return Inertia::render('Configuracoes/Filiais');
    })->name('filiais');
    /**ROTAS CONFIGURAÇÕES - EMPRESAS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/empresas', function () {
        return Inertia::render('Configuracoes/Empresas');
    })->name('empresas');
    /**ROTAS CONFIGURAÇÕES - WEBHOOKS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/webhooks', function () {
        return Inertia::render('Configuracoes/Webhooks');
    })->name('webhooks');
    /**ROTAS CONFIGURAÇÕES - USUÁRIOS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', function () {
        return Inertia::render('Configuracoes/Usuarios');
    })->name('usuarios');
    /**ROTAS CONFIGURAÇÕES - PERFIS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/perfis', function () {
        return Inertia::render('Configuracoes/Perfis');
    })->name('perfis');
    /**ROTAS CONFIGURAÇÕES - LOGS */
    Route::middleware(['auth:sanctum', 'verified'])->get('/logs', function () {
        return Inertia::render('Configuracoes/Logs');
    })->name('logs');
});
