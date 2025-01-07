<?php

namespace App\Repositories\Contracts;

use App\Models\Anchor;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AnchorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AnchorRepository extends BaseRepository implements AnchorRepositoryInterface
{
    public function __construct(Anchor $model)
    {
        parent::__construct($model);
    }

    public function allBySeoId($id)
    {
        return $this->model->where('seo_id', $id)->get();
    }

    public function updateById($id, array $data)
    {
       $this->model->query()->find($id)->update($data);
       return $this->model->query()->find($id);
    }
}
