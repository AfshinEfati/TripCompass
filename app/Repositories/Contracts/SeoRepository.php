<?php

namespace App\Repositories\Contracts;

use App\Models\Seo;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SeoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeoRepository extends BaseRepository implements SeoRepositoryInterface
{
    public function __construct(Seo $model)
    {
        parent::__construct($model);
    }

    public function store($data): Model
    {
        $seo = $this->model->query()->create($data);
        return $this->model->query()->with('content')->find($seo->id);
    }

    public function update(Seo|Model $model, $data): Model
    {
        $model->update($data);
        return $this->model->query()->with('content')->find($model->id);
    }

    public function destroy($id): bool
    {
        return $this->model->query()->find($id)->delete();
    }

    public function findWithAll(Seo $seo)
    {
        return $this->model->query()->with([
            'content',
            'seoRelation',
            'media',
            'anchors',
            'faqs'
        ])->find($seo->id);
    }

    public function getByCanonical(string $canonicalUrl)
    {
        if ($canonicalUrl === 'home') {
            return $this->model->query()->where('canonical', 'LIKE', '/')->with([
                'content',
                'seoRelation',
                'seoRelation.model',
                'seoRelation.model.city',
                'media',
                'faqs',
                'anchors'
            ])->first();
        }
       return $this->model->query()
           ->whereRaw('BINARY `canonical` = ?', [$canonicalUrl])
        ->with([
            'content',
            'seoRelation',
            'media',
            'faqs',
            'anchors'
        ])->first();

    }


    public function getSitemap(): Collection
    {
        return $this->model->query()->with([
            'content',
            'seoRelation',
            'media',
            'anchors',
            'faqs'
        ])->where('robots',true)->get();
    }
}
