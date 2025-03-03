<?php

namespace App\Repositories\Contracts;

use App\Models\ClickLog;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ClickLogRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ClickLogRepository extends BaseRepository implements ClickLogRepositoryInterface
{
    public function __construct(ClickLog $model)
    {
        parent::__construct($model);
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
}
