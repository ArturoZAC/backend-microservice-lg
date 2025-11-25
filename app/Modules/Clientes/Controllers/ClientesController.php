<?php

namespace App\Modules\Clientes\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;

//DTOS
use App\Modules\Clientes\DTOs\Clientes\CrearClienteDTO;
use App\Modules\Clientes\DTOs\Clientes\ActualizarClienteDTO;

//CASOS DE USO DE "CLIENTES"
use App\Modules\Clientes\UseCases\Cliente\ListaClientesUseCase;
use App\Modules\Clientes\UseCases\Cliente\CrearClienteUseCase;
use App\Modules\Clientes\UseCases\Cliente\ActualizarClienteUseCase;
use App\Modules\Clientes\UseCases\Cliente\BuscarClientePorIdUseCase;
use App\Modules\Clientes\UseCases\Cliente\EliminarClientePorIdUseCase;

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

    // public function listarClientes()
    // {
    //     try {
    //         $useCase = new ListaClientesUseCase($this->clienteRepository);
    //         $clientes = $useCase->execute(); // devuelve array de ClienteEntity

    //         // Asegurarse de que no se devuelva password
    //         $clientesArray = array_map(fn($c) => array_diff_key($c->toArray(), ['password' => '']), $clientes);

    //         return response()->json($clientesArray, 200);

    //     } catch (\Throwable $e) {
    //         return $this->handleError($e);
    //     }
    // }


    public function listarClientes(Request $request)
    {
        try {
            $search = $request->query('search');
            $registro = $request->query('registro');
            $tipoDocumento = $request->query('tipo_documento');
            $medioIngreso = $request->query('medio_ingreso');
            $perPage = intval($request->query('per_page', 10));

            $useCase = new ListaClientesUseCase($this->clienteRepository);
            $clientes = $useCase->execute(
                search: $search,
                registro: $registro,
                tipoDocumento: $tipoDocumento,
                medioIngreso: $medioIngreso,
                perPage: $perPage
            );

            // Ocultar password
            // $clientesArray = array_map(
            //     fn($c) => array_diff_key($c->toArray(), ['password' => '']),
            //     $clientes
            // );

            // return response()->json($clientesArray, 200);


            $clientes['data'] = array_map(
                fn($c) => array_diff_key($c->toArray(), ['password' => '']),
                $clientes['data']
            );

            return response()->json($clientes, 200);

        } catch (\Throwable $e) {
            return $this->handleError($e);
        }
    }

    public function buscarPorId($id)
    {
        try {
            $id = intval($id);

            if ($id <= 0) {
                return response()->json(['error' => 'ID inválido'], 400);
            }

            $cliente = (new BuscarClientePorIdUseCase($this->clienteRepository))
                ->execute($id);

            if (!$cliente) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }

            return response()->json($cliente->toArray(), 200);

        } catch (\Throwable $e) {
            return $this->handleError($e);
        }
    }


    public function eliminarCliente($id)
    {
        try {
            $id = intval($id);

            if ($id <= 0) {
                return response()->json(['error' => 'ID inválido'], 400);
            }

            // 1. Verificar si existe
            $cliente = (new BuscarClientePorIdUseCase($this->clienteRepository))
                ->execute($id);

            if (!$cliente) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }

            // 2. Eliminar
            $useCase = new EliminarClientePorIdUseCase($this->clienteRepository);
            $eliminado = $useCase->execute($id);

            if (!$eliminado) {
                return response()->json(['error' => 'No se pudo eliminar el cliente'], 500);
            }

            // 3. Retornar éxito
            return response()->json([
                'mensaje' => 'Cliente eliminado exitosamente',
                'id_eliminado' => $id
            ], 200);

        } catch (\Throwable $e) {
            return $this->handleError($e);
        }
    }


    public function actualizarCliente(Request $request, $id)
    {
        try {
            $requestData = array_merge($request->all(), ['id' => intval($id)]);

            [$error, $dto] = ActualizarClienteDTO::create($requestData);
            if ($error) {
                return response()->json(['error' => $error], 400);
            }

            // Verificar si existe
            $existente = (new BuscarClientePorIdUseCase($this->clienteRepository))
                ->execute($dto->id);

            if (!$existente) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }

            // Actualizar
            $useCase = new ActualizarClienteUseCase($this->clienteRepository);
            $actualizado = $useCase->execute($dto);

            return response()->json($actualizado->toArray(), 200);

        } catch (\Throwable $e) {
            return $this->handleError($e);
        }
    }
}
