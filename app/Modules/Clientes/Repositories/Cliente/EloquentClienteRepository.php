<?php

namespace App\Modules\Clientes\Repositories\Cliente;

use App\Modules\Clientes\Models\ClienteModel;
use App\Modules\Clientes\Entities\ClienteEntity;
use App\Modules\Clientes\DTOs\Clientes\CrearClienteDTO;

class EloquentClienteRepository extends ClienteRepositoryAbstract
{
    public function create(CrearClienteDTO $dto): ClienteEntity
    {
        $model = ClienteModel::create([
            'nombres' => $dto->nombres,
            'apellidos' => $dto->apellidos,
            'empresa' => $dto->empresa,
            'celular' => $dto->celular,
            'password' => bcrypt($dto->password),
            'edad' => $dto->edad,
            'email' => $dto->email,
            'sexo' => $dto->sexo,
            'medio_ingreso' => $dto->medio_ingreso,
            'registro' => $dto->registro,
            'tipo_documento' => $dto->tipo_documento,
            'numero_documento' => $dto->numero_documento,
            'estado' => $dto->estado,
            'antiguo' => $dto->antiguo,
            'puntuacion' => $dto->puntuacion,
        ]);

        return $this->mapToEntity($model);
    }

    //*Metodo sin filtrado ni buscador
    // public function getAll(): array
    // {
    //     return ClienteModel::all()
    //         ->map(fn ($m) => $this->mapToEntity($m))
    //         ->toArray();
    // }

    public function getAll(
        ?string $search = null,
        ?string $tipoDocumento = null,
        ?string $medioIngreso = null,
        int $perPage = 10
    ): array {
        $query = ClienteModel::query();

        // Buscador
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%$search%")
                ->orWhere('apellidos', 'like', "%$search%")
                ->orWhere('empresa', 'like', "%$search%")
                ->orWhere('celular', 'like', "%$search%")
                ->orWhere('numero_documento', 'like', "%$search%");
            });
        }

        // Filtros
        if ($tipoDocumento) {
            $query->where('tipo_documento', $tipoDocumento);
        }

        if ($medioIngreso) {
            $query->where('medio_ingreso', $medioIngreso);
        }

        // Paginación
        $results = $query->paginate($perPage);

        // Mapear a Entities
        return $results->getCollection()
            ->map(fn($m) => $this->mapToEntity($m))
            ->toArray();
    }


    public function findById(int $id): ?ClienteEntity
    {
        $model = ClienteModel::find($id);
        return $model ? $this->mapToEntity($model) : null;
    }

    public function delete(int $id): bool
    {
        $model = ClienteModel::find($id);
        return $model ? $model->delete() : false;
    }

    public function update(int $id, array $data): ?ClienteEntity
    {
        $model = ClienteModel::find($id);
        if (!$model) return null;

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $model->update($data);

        return $this->mapToEntity($model);
    }

    private function mapToEntity(ClienteModel $model): ClienteEntity
    {
        return new ClienteEntity(
            id: $model->id,
            nombres: $model->nombres,
            apellidos: $model->apellidos,
            empresa: $model->empresa,
            celular: $model->celular,
            password: $model->password,
            edad: $model->edad,
            email: $model->email,
            sexo: $model->sexo,
            medioIngreso: $model->medio_ingreso,
            registro: $model->registro,
            tipoDocumento: $model->tipo_documento,
            numeroDocumento: $model->numero_documento,
            estado: $model->estado,
            antiguo: $model->antiguo,
            puntuacion: $model->puntuacion
        );
    }
}
