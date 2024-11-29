<?php

namespace App\Repositories\Contracts;

use App\Models\State;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\StateRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StateRepository extends BaseRepository implements StateRepositoryInterface
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }
    public function update(Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }
}
