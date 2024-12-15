<?php

namespace App\Services;

use App\Models\SeoRelation;
use App\Repositories\Interfaces\SeoRelationRepositoryInterface;

class SeoRelationService
{
    public function __construct(public SeoRelationRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(SeoRelation $seoRelation, array $data)
    {
        return $this->repository->update($seoRelation, $data);
    }

    public function delete(SeoRelation $seoRelation)
    {
        return $this->repository->destroy($seoRelation->id);
    }
}
