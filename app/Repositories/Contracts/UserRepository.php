<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function update(User|Model $model, array $data): Model|Collection|Builder|array|null
    {
        if (isset($data['password']))
            $data['password'] = bcrypt($data['password']);
        $this->model->query()->find($model->id)->update($data);
        return $model->refresh();
    }

    public function store(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->model->query()->create($data);
    }

    public function destroy($id): void
    {
        $this->model->query()->find($id)->update(['is_active' => 0]);
    }
}
