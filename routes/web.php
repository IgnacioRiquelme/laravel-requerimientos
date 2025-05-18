<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RequerimientoController; // Asegúrate de importar tu controlador

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Ruta común de dashboard (requiere autenticación)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === RUTAS PERSONALIZADAS SEGÚN EL ROL (Analista / Operador) ===
    Route::get('/menu-analista', function () {
        return view('menus.analista-menu'); // Vista para analista
    })->name('menu.analista')->middleware('auth');

    Route::get('/menu-operador', function () {
        return view('menus.operador-menu'); // Vista para operador
    })->name('menu.operador')->middleware('auth');

    // Ruta para el formulario de ingreso de requerimientos
    Route::get('/requerimientos/create', [RequerimientoController::class, 'create'])->name('requerimientos.create');
    Route::post('/requerimientos', [RequerimientoController::class, 'store'])->name('requerimientos.store'); // Almacenar requerimiento
});

require __DIR__.'/auth.php';


