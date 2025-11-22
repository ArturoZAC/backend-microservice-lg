<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Entities\ClienteEntity;
use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;

class BuscarClientePorIdUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $clienteRepository
    ) {}

    public function execute(int $id): ClienteEntity|null
    {
        return $this->clienteRepository->findById($id);
    }
}
