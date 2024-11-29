<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();
    public function show($id);
    public function store(array $data);
    public function update(Model $model, array $data);
    public function destroy($id);
}
