<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface AnchorRepositoryInterface extends BaseRepositoryInterface
{

    public function allBySeoId($id);
   public function updateById($id, array $data);
}
