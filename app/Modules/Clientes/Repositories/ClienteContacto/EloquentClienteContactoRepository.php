<?php

namespace App\Modules\Clientes\Repositories\ClienteContacto;

use App\Modules\Clientes\Models\ClienteContactoModel;
use App\Modules\Clientes\Entities\ClienteContactoEntity;
use App\Modules\Clientes\DTOs\ClientesContacto\CrearClienteContactoDTO;
use App\Modules\Clientes\DTOs\ClientesContacto\ActualizarContactoDTO;

class EloquentClienteContactoRepository extends ClienteContactoRepositoryAbstract
{
    public function create(int $clienteId, CrearClienteContactoDTO $dto): ClienteContactoEntity
    {
        $model = ClienteContactoModel::create([
            'cliente_id' => $clienteId,
            'nombres' => $dto->nombres,
            'celular' => $dto->celular,
            'correo' => $dto->correo,
            'tipo_documento' => $dto->tipo_documento,
            'numero_documento' => $dto->numero_documento,
        ]);

        return $this->mapToEntity($model);
    }

    public function getAll(int $clienteId): array
    {
        return ClienteContactoModel::where('cliente_id', $clienteId)
            ->get()
            ->map(fn($m) => $this->mapToEntity($m))
            ->toArray();
    }

    public function findById(int $id): ?ClienteContactoEntity
    {
        $model = ClienteContactoModel::find($id);
        return $model ? $this->mapToEntity($model) : null;
    }

    public function update(ActualizarContactoDTO $dto): ?ClienteContactoEntity
    {
        $model = ClienteContactoModel::find($dto->id);
        if (!$model) return null;

        $model->update([
            'nombres' => $dto->nombres,
            'celular' => $dto->celular,
            'correo' => $dto->correo,
            'tipo_documento' => $dto->tipo_documento,
            'numero_documento' => $dto->numero_documento,
        ]);

        return $this->mapToEntity($model);
    }

    public function delete(int $id): bool
    {
        $model = ClienteContactoModel::find($id);
        return $model ? $model->delete() : false;
    }

    private function mapToEntity(ClienteContactoModel $model): ClienteContactoEntity
    {
        return new ClienteContactoEntity(
            id: $model->id,
            cliente_id: $model->cliente_id,
            nombres: $model->nombres,
            celular: $model->celular,
            correo: $model->correo,
            tipo_documento: $model->tipo_documento,
            numero_documento: $model->numero_documento
        );
    }
}
