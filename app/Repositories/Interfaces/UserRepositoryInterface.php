<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function update(User|Model $model, array $data);

    public function store(array $data);

    public function destroy($id);
}
