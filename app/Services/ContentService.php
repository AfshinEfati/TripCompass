<?php

namespace App\Services;

use App\Models\Content;
use App\Repositories\Interfaces\ContentRepositoryInterface;

class ContentService
{
    public function __construct(public ContentRepositoryInterface $repository)
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
    public function update(Content $content, array $data)
    {
        return $this->repository->update($content, $data);
    }
    public function delete(Content $content)
    {
        return $this->repository->destroy($content->id);
    }
}
