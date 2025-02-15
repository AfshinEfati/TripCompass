<?php

namespace App\Repositories\Contracts;

use App\Models\Airline;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AirlineRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AirlineRepository extends BaseRepository implements AirlineRepositoryInterface
{
    public function __construct(Airline $model)
    {
        parent::__construct($model);
    }

    public function getAirlineIdByCode($code)
    {
        $airline =  $this->model->where('iata_code', $code)->first();
        if ($airline) {
            return $airline->id;
        }else{
            $airline= $this->model->create([
                'name_en'=>$code,
                'name_fa'=>$code,
                'iata_code'=>$code,
                'icao_code'=>$code,
                'country_id'=>1,
                'logo_url'=>'default.png',
                'is_active'=>1,
                'description'=>'default',
            ]);
            return $airline->id;
        }
    }
}
