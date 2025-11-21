<?php

namespace App\Modules\Clientes\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Clientes\Repositories\Cliente\ClienteRepositoryAbstract;
use App\Modules\Clientes\Repositories\Cliente\EloquentClienteRepository;

class ClienteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ClienteRepositoryAbstract::class,
            EloquentClienteRepository::class
        );
    }
}
