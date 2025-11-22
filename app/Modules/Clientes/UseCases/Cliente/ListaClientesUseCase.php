<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;

class ListaClientesUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
