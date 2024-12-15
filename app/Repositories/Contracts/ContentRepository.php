<?php

namespace App\Repositories\Contracts;

use App\Models\Content;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContentRepository extends BaseRepository implements ContentRepositoryInterface
{
    public function __construct(Content $model)
    {
        parent::__construct($model);
    }
    public function all(): Collection
    {
        return $this->model->with('seo')->get();
    }
}
