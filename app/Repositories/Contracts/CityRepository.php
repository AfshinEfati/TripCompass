<?php

namespace App\Repositories\Contracts;

use App\Models\City;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
    public function update(Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }
}
