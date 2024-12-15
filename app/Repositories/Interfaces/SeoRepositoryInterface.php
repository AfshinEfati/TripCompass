<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface SeoRepositoryInterface extends BaseRepositoryInterface
{

    public function findWithAll(\App\Models\Seo $seo);
}
