<?php

namespace App\Repositories\Contracts;

use App\Models\Agency;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyRepository extends BaseRepository implements AgencyRepositoryInterface
{
    public function __construct(Agency $model)
    {
        parent::__construct($model);
    }

    public function getByUserId(int|string|null $id): Collection
    {
        return $this->model->query()->with(['owner', 'services'])->where('user_id', $id)->get();
    }
    public function show($id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->with(['wallet'])->find($id);
    }
}
