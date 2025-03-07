<?php

namespace App\Repositories\Contracts;

use App\Models\Bank;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BankRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BankRepository extends BaseRepository implements BankRepositoryInterface
{
    public function __construct(Bank $model)
    {
        parent::__construct($model);
    }
}
