<?php

namespace App\Modules\Clientes\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Clientes\Repositories\ClienteContacto\ClienteContactoRepositoryAbstract;

//DTOS DE CLIENTE CONTACTO
use App\Modules\Clientes\DTOs\ClientesContacto\CrearClienteContactoDTO;
use App\Modules\Clientes\DTOs\ClientesContacto\ActualizarContactoDTO;

//CASOS DE USO DE CLIENTE CONTACTO
use App\Modules\Clientes\UseCases\ClienteContacto\CrearClienteContactoUseCase;
use App\Modules\Clientes\UseCases\ClienteContacto\BuscarContactoPorIdUseCase;
use App\Modules\Clientes\UseCases\ClienteContacto\EliminarContactoPorIdUseCase;
use App\Modules\Clientes\UseCases\ClienteContacto\ListaContactosUseCase;
use App\Modules\Clientes\UseCases\ClienteContacto\ActualizarContactoUseCase;


class ClienteContactoController extends Controller
{
    public function __construct(
        private readonly ClienteContactoRepositoryAbstract $contactoRepository
    ) {}

    public function crearClienteContacto(Request $request, $clienteId)
    {
        try {
            [$error, $dto] = CrearClienteContactoDTO::create($request->all());
            if ($error) {
                return response()->json(['error' => $error], 400);
            }

            $useCase = new CrearClienteContactoUseCase($this->contactoRepository);
            $contactoCreado = $useCase->execute(intval($clienteId), $dto);

            return response()->json($contactoCreado->toArray(), 201);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listarClientesContactos($clienteId)
    {
        $contactos = (new ListaContactosUseCase($this->contactoRepository))
            ->execute((int)$clienteId);

        return response()->json(
            array_map(fn($c) => $c->toArray(), $contactos), 200
        );
    }

    public function buscarClienteContactoPorId($id)
    {
        $contacto = (new BuscarContactoPorIdUseCase($this->contactoRepository))
            ->execute((int)$id);

        if (!$contacto) return response()->json(['error' => 'No encontrado'], 404);

        return response()->json($contacto->toArray(), 200);
    }

    public function eliminarClienteContactoPorId($id)
    {
        $useCase = new EliminarContactoPorIdUseCase($this->contactoRepository);

        if (!$useCase->execute((int)$id)) {
            return response()->json(['error' => 'No eliminado'], 400);
        }

        return response()->json(['mensaje' => 'Eliminado correctamente'], 200);
    }

    public function actualizarClienteContacto(Request $request, $id)
    {
        try {
            $payload = array_merge($request->all(), ['id' => intval($id)]);
            [$error, $dto] = ActualizarContactoDTO::create($payload);
            if ($error) return response()->json(['error' => $error], 400);

            $exist = (new BuscarContactoPorIdUseCase($this->contactoRepository))->execute($dto->id);
            if (!$exist) return response()->json(['error' => 'Contacto no encontrado'], 404);

            $updated = (new ActualizarContactoUseCase($this->contactoRepository))->execute($dto);
            if (!$updated) return response()->json(['error' => 'No se pudo actualizar'], 500);

            return response()->json($updated->toArray(), 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
