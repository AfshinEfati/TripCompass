<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function getByUserId()
    {
        return $this->model->where('user_id', auth()->id())->get();
    }

}
