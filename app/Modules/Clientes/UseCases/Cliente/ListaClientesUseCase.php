<?php

namespace App\Modules\Clientes\UseCases\Cliente;

use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;

class ListaClientesUseCase
{
    public function __construct(
        private readonly ClienteRepositoryAbstract $repository
    ) {}

    public function execute(
        ?string $search = null,
        ?string $registro = null,
        ?string $tipoDocumento = null,
        ?string $medioIngreso = null,
        int $perPage = 10
    ): array {
        return $this->repository->getAll(
            search: $search,
            registro: $registro,
            tipoDocumento: $tipoDocumento,
            medioIngreso: $medioIngreso,
            perPage: $perPage
        );
    }
}
