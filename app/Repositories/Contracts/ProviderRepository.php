<?php

namespace App\Repositories\Contracts;

use App\Models\Provider;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProviderRepository extends BaseRepository implements ProviderRepositoryInterface
{

   public function __construct(Provider $model)
   {
       parent::__construct($model);
   }

    public function findByEmail(string $email): ?Provider
    {
        return $this->model->where('email', $email)->first();
    }
}
