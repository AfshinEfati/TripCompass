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

    public function getAirports(string|null $query): Collection
    {
        $builder = $this->model->query()
            ->where('domestic_flight', true)
            ->where('is_active', true);
        if ($query) {
            $builder->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name_en', 'LIKE', '%' . $query . '%')
                    ->orWhere('name_fa', 'LIKE', '%' . $query . '%')
                    ->orWhere('iata_code', 'LIKE', '%' . $query . '%')
                    ->orWhere('icao_code', 'LIKE', '%' . $query . '%');
            });
        } else {
            $builder->where('is_popular', true);
        }

        return $builder->get();
    }

}
