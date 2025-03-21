<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface SeoRepositoryInterface extends BaseRepositoryInterface
{

    public function findWithAll(\App\Models\Seo $seo);

    public function getByCanonical(string $canonicalUrl);

    public function getSitemap();

}
