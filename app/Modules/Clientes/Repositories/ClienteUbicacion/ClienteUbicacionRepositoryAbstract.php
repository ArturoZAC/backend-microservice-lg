<?php

namespace App\Modules\Clientes\Repositories\ClienteUbicacion;

use App\Modules\Clientes\DTOs\ClientesUbicacion\CrearClienteUbicacionDTO;
use App\Modules\Clientes\DTOs\ClientesUbicacion\ActualizarClienteUbicacionDTO;
use App\Modules\Clientes\Entities\ClienteUbicacionEntity;

abstract class ClienteUbicacionRepositoryAbstract
{
    abstract public function create(int $clienteId, CrearClienteUbicacionDTO $dto): ClienteUbicacionEntity;

    /** @return ClienteUbicacionEntity[] */
    abstract public function getAll(int $clienteId): array;

    abstract public function findById(int $id): ?ClienteUbicacionEntity;

    abstract public function update(ActualizarClienteUbicacionDTO $dto): ?ClienteUbicacionEntity;

    abstract public function delete(int $id): bool;
}
