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

    public function store($data): Model
    {
        $seo = $this->model->query()->create($data);
        return $this->model->query()->with('content')->find($seo->id);
    }

    public function update(Seo|Model $model, $data): Model
    {
        $model->update($data);
        return $this->model->query()->with('content')->find($seo->id);
    }

    public function destroy($id): bool
    {
        return $this->model->query()->find($id)->delete();
    }
}
