<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->query()->orderBy('id','asc')->get();
    }

    public function show($id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->query()->create($data);
    }

    public function update($id, array $data): Model|Collection|Builder|array|null
    {
        $model = $this->model->query()->findOrFail($id);
        $model->update($data);
        return $model->refresh();
    }

    public function destroy($id)
    {
        $model = $this->model->query()->findOrFail($id);
        return $model->delete();
    }
}

