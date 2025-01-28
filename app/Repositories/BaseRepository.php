<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Builder|Model|BelongsToMany|Relation $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->query()->orderBy('id', 'desc')->get();
    }

    public function show($id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->query()->create($data);
    }

    public function update(Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->update($data);
        return $model->refresh();
    }

    public function destroy($id)
    {
        $model = $this->model->query()->findOrFail($id);
        return $model->delete();
    }
}

