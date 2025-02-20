<?php

namespace App\Repositories\Interfaces;

use App\Models\Agency;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface AgencyServiceRepositoryInterface extends BaseRepositoryInterface
{

    public function getByAgencyId($agencyId);
    public function delete($agencyId,$agencyServiceId);
    public function update(Model $model, array $data);

    public function storeByAgency(Agency $agency, array $data);
}
