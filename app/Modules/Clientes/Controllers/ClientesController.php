<?php

namespace App\Modules\Clientes\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;
use App\Modules\Clientes\DTOs\Clientes\CrearClienteDTO;
use App\Modules\Clientes\UseCases\Cliente\CrearClienteUseCase;

class ClientesController extends Controller
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $clienteRepository
    ) {}

    private function handleError(\Throwable $error)
    {
        return response()->json([
            'error' => $error->getMessage()
        ], 500);
    }

    public function crearCliente(Request $request)
    {
        try {

            // 1. Validar DTO estilo Zod (ya hace todas las validaciones)
            [$error, $dto] = CrearClienteDTO::create($request->all());
            if ($error) {
                return response()->json(['error' => $error ], 400);
            }

            // 2. Ejecutar use case
            $clienteCreado = (new CrearClienteUseCase($this->clienteRepository))
                ->execute($dto);

            // 3. Retornar entidad
            return response()->json($clienteCreado->toArray(), 201);

        } catch (\Throwable $e) {
            return $this->handleError($e);
        }
    }
}
