<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;

class EliminarClientePorIdUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $clienteRepository
    ) {}

    public function execute(int $id)
    {
        return $this->clienteRepository->delete($id);
    }
}
