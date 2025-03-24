<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\AgencyWalletRepositoryInterface;
use App\Models\AgencyWallet;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyWalletRepository extends BaseRepository implements AgencyWalletRepositoryInterface
{
    public function __construct(AgencyWallet $model)
    {
        parent::__construct($model);
    }

    public function charge(mixed $validated)
    {
        // TODO: Implement charge() method.
    }
}
