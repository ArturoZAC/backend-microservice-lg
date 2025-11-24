<?php

namespace App\Modules\Clientes\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Clientes\Repositories\ClienteUbicacion\ClienteUbicacionRepositoryAbstract;

// DTOs
use App\Modules\Clientes\DTOs\ClientesUbicacion\CrearClienteUbicacionDTO;
use App\Modules\Clientes\DTOs\ClientesUbicacion\ActualizarClienteUbicacionDTO;

// Use Cases
use App\Modules\Clientes\UseCases\ClienteUbicacion\CrearClienteUbicacionUseCase;
use App\Modules\Clientes\UseCases\ClienteUbicacion\ActualizarClienteUbicacionUseCase;
use App\Modules\Clientes\UseCases\ClienteUbicacion\ListaUbicacionesUseCase;
use App\Modules\Clientes\UseCases\ClienteUbicacion\BuscarUbicacionPorIdUseCase;
use App\Modules\Clientes\UseCases\ClienteUbicacion\EliminarUbicacionUseCase;

class ClienteUbicacionController extends Controller
{
    public function __construct(
        private readonly ClienteUbicacionRepositoryAbstract $repository
    ) {}

    public function crearClienteUbicacion(Request $request, $clienteId)
    {
        try {
            [$error, $dto] = CrearClienteUbicacionDTO::create($request->all());
            if ($error) return response()->json(['error' => $error], 400);

            $useCase = new CrearClienteUbicacionUseCase($this->repository);
            $ubicacionCreada = $useCase->execute(intval($clienteId), $dto);

            return response()->json($ubicacionCreada->toArray(), 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listarUbicaciones($clienteId)
    {
        $useCase = new ListaUbicacionesUseCase($this->repository);
        $ubicaciones = $useCase->execute((int)$clienteId);

        return response()->json(array_map(fn($u) => $u->toArray(), $ubicaciones), 200);
    }

    public function buscarUbicacionPorId($id)
    {
        $useCase = new BuscarUbicacionPorIdUseCase($this->repository);
        $ubicacion = $useCase->execute((int)$id);

        if (!$ubicacion) return response()->json(['error' => 'No encontrado'], 404);

        return response()->json($ubicacion->toArray(), 200);
    }

    public function actualizarClienteUbicacion(Request $request, $id)
    {
        try {
            $payload = array_merge($request->all(), ['id' => intval($id)]);
            [$error, $dto] = ActualizarClienteUbicacionDTO::create($payload);
            if ($error) return response()->json(['error' => $error], 400);

            $exist = (new BuscarUbicacionPorIdUseCase($this->repository))->execute($dto->id);
            if (!$exist) return response()->json(['error' => 'Ubicación no encontrada'], 404);

            $updated = (new ActualizarClienteUbicacionUseCase($this->repository))->execute($dto);
            if (!$updated) return response()->json(['error' => 'No se pudo actualizar'], 500);

            return response()->json($updated->toArray(), 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function eliminarClienteUbicacion($id)
    {
        $useCase = new EliminarUbicacionUseCase($this->repository);
        $deleted = $useCase->execute((int)$id);

        if (!$deleted) return response()->json(['error' => 'No eliminado'], 400);

        return response()->json(['mensaje' => 'Eliminado correctamente'], 200);
    }
}
