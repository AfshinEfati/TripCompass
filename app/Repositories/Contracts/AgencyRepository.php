<?php

namespace App\Repositories\Contracts;

use App\Models\Agency;
use App\Models\State;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AgencyRepositoryInterface;
use App\Repositories\Interfaces\StateRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyRepository extends BaseRepository implements AgencyRepositoryInterface
{
    public function __construct(Agency $model)
    {
        parent::__construct($model);
    }
    public function update(Agency|Model $model, array $data): Model|Collection|Builder|array|null
    {
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }
    public function destroy($id): void
    {
        $this->model->query()->find($id)->update(['is_active' => 0]);
    }
}
