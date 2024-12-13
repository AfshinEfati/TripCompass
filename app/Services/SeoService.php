<?php

namespace App\Services;

use App\Repositories\Interfaces\SeoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SeoService
{
    public function __construct(public SeoRepositoryInterface $repository)
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
    public function update(array $data, Model $seo)
    {
        return $this->repository->update( $seo, $data);
    }
    public function delete(Model $seo)
    {
        return $this->repository->destroy($seo->id);
    }
}
