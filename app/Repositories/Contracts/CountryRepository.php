<?php

namespace App\Repositories\Contracts;

use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
