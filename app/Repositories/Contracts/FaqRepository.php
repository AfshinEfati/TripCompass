<?php

namespace App\Repositories\Contracts;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FaqRepository implements FaqRepositoryInterface
{
    protected Faq $model;
    public function __construct()
    {
       $this->model = new Faq();
    }


    public function all(int $id)
    {
        return $this->model->where('seo_id', $id)->get();
    }

    public function store(mixed $validated)
    {
        return $this->model->create($validated);
    }

    public function update(mixed $id, mixed $validated)
    {
        $faq = $this->model->find($id);
        $faq->update($validated);
        return $faq;
    }

    public function destroy(int $id): void
    {
        $faq = $this->model->find($id);
        $faq->delete();
    }

    public function findById(int $id): Faq
    {
        return $this->model->find($id);
    }

}
