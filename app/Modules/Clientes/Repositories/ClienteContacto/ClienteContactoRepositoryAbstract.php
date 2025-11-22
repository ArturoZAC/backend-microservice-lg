<?php

namespace App\Modules\Clientes\Repositories\ClienteContacto;

use App\Modules\Clientes\DTOs\ClientesContacto\CrearClienteContactoDTO;
use App\Modules\Clientes\DTOs\ClientesContacto\ActualizarContactoDTO;
use App\Modules\Clientes\Entities\ClienteContactoEntity;

abstract class ClienteContactoRepositoryAbstract
{
    abstract public function create(int $clienteId, CrearClienteContactoDTO $dto): ClienteContactoEntity;

    /** @return ClienteContactoEntity[] */
    abstract public function getAll(int $clienteId): array;

    abstract public function findById(int $id): ?ClienteContactoEntity;

    abstract public function update(ActualizarContactoDTO $dto): ?ClienteContactoEntity;

    abstract public function delete(int $id): bool;
}
