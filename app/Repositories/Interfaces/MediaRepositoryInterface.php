<?php

namespace App\Repositories\Interfaces;

interface MediaRepositoryInterface
{
    public function upload(array $data): void;
    public function delete(int $id): bool;

}
