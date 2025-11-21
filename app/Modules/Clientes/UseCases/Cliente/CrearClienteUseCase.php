<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;
use App\Modules\Clientes\DTOs\Clientes\CrearClienteDTO;
use App\Modules\Clientes\Entities\ClienteEntity;

class CrearClienteUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $repository
    ) {}

    public function execute(CrearClienteDTO $dto): ClienteEntity
    {
        return $this->repository->create($dto);
    }
}
