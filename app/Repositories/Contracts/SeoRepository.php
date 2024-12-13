<?php

namespace App\Repositories\Contracts;

use App\Models\Seo;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SeoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SeoRepository extends BaseRepository implements SeoRepositoryInterface
{
    public function __construct(Seo $model)
    {
        parent::__construct($model);
    }
}
