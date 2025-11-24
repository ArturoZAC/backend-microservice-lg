<?php

namespace App\Modules\Clientes\Repositories\Cliente;

use App\Modules\Clientes\DTOs\Clientes\CrearClienteDTO;
use App\Modules\Clientes\Entities\ClienteEntity;

abstract class ClienteRepositoryAbstract
{
    abstract public function create(CrearClienteDTO $dto): ClienteEntity;

    //*Metodo sin filtros ni buscador
    // /** @return ClienteEntity[] */
    // abstract public function getAll(): array;

    // abstract public function getAll(): array;
    /** 
     * @param string|null $search
     * @param string|null $tipoDocumento
     * @param string|null $medioIngreso
     * @param int $perPage
     * @return ClienteEntity[]
     */
    abstract public function getAll(
        ?string $search = null,
        ?string $tipoDocumento = null,
        ?string $medioIngreso = null,
        int $perPage = 10
    ): array;

    abstract public function findById(int $id): ?ClienteEntity;

    abstract public function delete(int $id): bool;

    abstract public function update(int $id, array $data): ?ClienteEntity;
}
