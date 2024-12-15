<?php

namespace App\Repositories\Contracts;

use App\Models\SeoRelation;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SeoRelationRepositoryInterface;

class SeoRelationRepository extends BaseRepository implements SeoRelationRepositoryInterface
{
    public function __construct(SeoRelation $model)
    {
        parent::__construct($model);
    }
}
