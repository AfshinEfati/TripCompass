<?php

namespace App\Repositories\Contracts;

use App\Models\Airport;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AirportRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AirportRepository extends BaseRepository implements AirportRepositoryInterface
{
    public function __construct(Airport $model)
    {
        parent::__construct($model);
    }
    public function update(Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }
}