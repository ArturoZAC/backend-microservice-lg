<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Clientes\Controllers\ClientesController;
use App\Modules\Clientes\Controllers\ClienteContactoController;

// CRUD de clientes
Route::post('/', [ClientesController::class, 'crearCliente']);
Route::get('/', [ClientesController::class, 'listarClientes']);
Route::get('/{id}', [ClientesController::class, 'buscarPorId']);
Route::delete('/{id}', [ClientesController::class, 'eliminarCliente']);
Route::put('/{id}', [ClientesController::class, 'actualizarCliente']);

// CRUD de contactos de clientes, usando clienteId en la URL
Route::post('/{clienteId}/contactos', [ClienteContactoController::class, 'crearClienteContacto']);
Route::get('/{clienteId}/contactos', [ClienteContactoController::class, 'listarClientesContactos']);

Route::get('/contactos/{id}', [ClienteContactoController::class, 'buscarClienteContactoPorId']);
Route::put('/contactos/{id}', [ClienteContactoController::class, 'actualizarClienteContacto']);
Route::delete('/contactos/{id}', [ClienteContactoController::class, 'eliminarClienteContactoPorId']);