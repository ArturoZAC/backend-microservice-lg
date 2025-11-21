<?php

use Illuminate\Support\Facades\Route;

// Rutas del módulo Clientes
Route::prefix('clientes')->group(function () {
    require base_path('app/Modules/Clientes/routes.php');
});
