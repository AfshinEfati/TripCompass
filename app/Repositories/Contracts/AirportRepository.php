<?php

namespace App\Repositories\Contracts;

use App\Models\Airport;
use App\Models\Seo;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AirportRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $builder = $this->model->query()->with('city')
            ->where('domestic_flight', true)
            ->where('is_active', true);
        if ($query) {
            $builder->where(function ($q) use ($query) {
                $q->where('name_en', 'LIKE', '%' . $query . '%')
                    ->orWhere('name_fa', 'LIKE', '%' . $query . '%')
                    ->orWhere('iata_code', 'LIKE', '%' . $query . '%')
                    ->orWhere('icao_code', 'LIKE', '%' . $query . '%')
                    ->orWhereHas('city', function ($cityQuery) use ($query) {
                        $cityQuery->where('name_en', 'LIKE', '%' . $query . '%')
                            ->orWhere('name_fa', 'LIKE', '%' . $query . '%');
                    });
            });
        } else {
            $builder->where('is_popular', true);
        }

        return $builder->get();
    }

    public function getByIataCode(mixed $destination)
    {
        $airport = $this->model->query()->where('iata_code', $destination)->first();
        if (!$airport)
            throw new ModelNotFoundException("not found");
        return $airport->id;
    }

    public function store(array $data): Model
    {
        $newAirport = $this->model->query()->create($data);
        $airports = $this->model->query()->with('city')->where('domestic_flight', true)->get();
        foreach ($airports as $airport) {
            foreach ($airports as $airport2) {
                if ($airport->id !== $airport2->id) {
                    $airportName = strtoupper($airport->iata_code);
                    $airport2Name = strtoupper($airport2->iata_code);
                    $seo = Seo::query()->where('canonical', "flight/{$airportName}-{$airport2Name}")->first();
                    if ($seo) {
                        continue;
                    }
                    $seo = Seo::create([
                        'title' => $airport->city->name_fa . ' به ' . $airport2->city->name_fa,
                        'description' => $airport->city->name_fa . ' به ' . $airport2->city->name_fa,
                        'canonical' => "flight/{$airportName}-{$airport2Name}",
                        'robots' => 0
                    ]);
                    $seo->content()->create([
                        'title_fa' => $seo->title,
                        'content' => $seo->title
                    ]);
                    $seo->seoRelation()->createMany([
                        [
                            "model_id" => $airport->id,
                            "model_type" => Airport::class,
                            "relation_type" => "origin"
                        ],
                        [
                            "model_id" => $airport2->id,
                            "model_type" => Airport::class,
                            "relation_type" => "destination"
                        ]
                    ]);
                }
            }
        }
        return $newAirport;
    }
}
