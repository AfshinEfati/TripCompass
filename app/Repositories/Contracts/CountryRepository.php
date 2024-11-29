<?php

namespace App\Repositories\Contracts;

use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function update(Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }
}
