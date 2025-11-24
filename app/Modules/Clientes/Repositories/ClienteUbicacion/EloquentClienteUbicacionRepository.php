<?php

namespace App\Modules\Clientes\Repositories\ClienteUbicacion;

use App\Modules\Clientes\Models\ClienteUbicacionModel;
use App\Modules\Clientes\Entities\ClienteUbicacionEntity;
use App\Modules\Clientes\DTOs\ClientesUbicacion\CrearClienteUbicacionDTO;
use App\Modules\Clientes\DTOs\ClientesUbicacion\ActualizarClienteUbicacionDTO;

class EloquentClienteUbicacionRepository extends ClienteUbicacionRepositoryAbstract
{
    public function create(int $clienteId, CrearClienteUbicacionDTO $dto): ClienteUbicacionEntity
    {
        $model = ClienteUbicacionModel::create([
            'cliente_id'  => $clienteId,
            'latitud'     => $dto->latitud,
            'longitud'    => $dto->longitud,
            'pais'        => $dto->pais,
            'departamento'=> $dto->departamento,
            'distrito'    => $dto->distrito,
        ]);

        return $this->mapToEntity($model);
    }

    public function getAll(int $clienteId): array
    {
        return ClienteUbicacionModel::where('cliente_id', $clienteId)
            ->get()
            ->map(fn($m) => $this->mapToEntity($m))
            ->toArray();
    }

    public function findById(int $id): ?ClienteUbicacionEntity
    {
        $model = ClienteUbicacionModel::find($id);
        return $model ? $this->mapToEntity($model) : null;
    }

    public function update(ActualizarClienteUbicacionDTO $dto): ?ClienteUbicacionEntity
    {
        $model = ClienteUbicacionModel::find($dto->id);
        if (!$model) return null;

        $dataToUpdate = array_filter([
            'latitud'     => $dto->latitud,
            'longitud'    => $dto->longitud,
            'pais'        => $dto->pais,
            'departamento'=> $dto->departamento,
            'distrito'    => $dto->distrito,
        ], fn($v) => $v !== null);

        $model->update($dataToUpdate);

        return $this->mapToEntity($model);
    }

    public function delete(int $id): bool
    {
        $model = ClienteUbicacionModel::find($id);
        return $model ? $model->delete() : false;
    }

    private function mapToEntity(ClienteUbicacionModel $model): ClienteUbicacionEntity
    {
        return new ClienteUbicacionEntity(
            id: $model->id,
            cliente_id: $model->cliente_id,
            latitud: $model->latitud,
            longitud: $model->longitud,
            pais: $model->pais,
            departamento: $model->departamento,
            distrito: $model->distrito
        );
    }
}
