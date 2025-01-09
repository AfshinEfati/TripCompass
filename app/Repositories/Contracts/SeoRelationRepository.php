<?php

namespace App\Repositories\Contracts;

use App\Models\SeoRelation;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SeoRelationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeoRelationRepository extends BaseRepository implements SeoRelationRepositoryInterface
{
    public function __construct(SeoRelation $model)
    {
        parent::__construct($model);
    }
   public function update(Model $model, array $data): Model|Collection|Builder|array|null
   {
         $this->model->query()->find($model->id)->update($data);
         return $model->refresh();
   }
}
