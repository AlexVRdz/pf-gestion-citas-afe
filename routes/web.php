<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\TipoContratoController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\TipoEnfermedadController;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas exclusivas para Admin
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('users', UserController::class)->except(['destroy']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('estados', EstadoController::class);
        Route::resource('tipo-pagos', TipoPagoController::class);
        Route::resource('medicos', MedicoController::class);
        Route::resource('tipo-contratos', TipoContratoController::class);
    });

    // Rutas para Admin y Doctor
    Route::middleware(['role:Admin,Doctor'])->group(function () {
        Route::resource('tipo-enfermedades', TipoEnfermedadController::class)->only(['index']);
    Route::resource('historial-medicos', HistorialMedicoController::class);

    });

    // Rutas para Admin y Secretaria
    Route::middleware(['role:Admin,Secretaria'])->group(function () {
        Route::resource('citas', CitaController::class)->middleware(['auth', 'verified']);
       // Route::get('pacientes/registro', [PacienteController::class, 'registro'])->name('pacientes.registro');
    });

    // Rutas compartidas para todos los roles autenticados
    Route::resource('citas', CitaController::class)->only(['index', 'show']);
    Route::resource('pacientes', PacienteController::class)->only(['index', 'show']);
    
});
