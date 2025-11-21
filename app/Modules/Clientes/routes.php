<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Clientes\Controllers\ClientesController;

// POST /clientes → llama al método crearCliente del controller
Route::post('/clientes', [ClientesController::class, 'crearCliente']);
