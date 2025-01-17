<?php

namespace App\Repositories\Contracts;

use App\Models\Media;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Str;
use Intervention\Image\ImageManager;

class MediaRepository implements MediaRepositoryInterface
{
    public Model $model;

    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    /**
     * @throws Exception
     */
    public function upload(array $data): void
    {
        $data = (object)$data;
        $name = 'unknown';

        if (!$data->model_id || !$data->model_type) {
            $filePath = "media";
            $lastMedia = $this->model->query()->get()->last();
        } else {
            $filePath = "media/" . collect(Explode('\\', $data->model_type))->last() . "/" . $data->model_id;
            $lastMedia = $this->model->query()->where('model_id', $data->model_id)->where('model_type', $data->model_type)->get()->last();
            $modelType = $data->model_type;
            $modelId = $data->model_id;
            $modelClass = $modelType;
            if (class_exists($modelClass)) {
                $relatedModel = $modelClass::find($modelId);
                if ($relatedModel)
                    $name = Str::slug($relatedModel->name);
            }

        }
        $priority = $lastMedia ? $lastMedia->priority : 0;
        $files = $data->files;
        foreach ($files as $file) {
            $priority++;
            $filename = $this->getFilename($file['file'], $filePath, $name);
            $relativePath = $filePath . '/' . $filename;
            $this->model->query()->create([
                'model_id' => (int)$data->model_id ?? null,
                'model_type' => $data->model_type ?? null,
                'file_name' => $filename,
                'mime_type' => Storage::disk('public')->mimeType($relativePath),
                'file_size' => Storage::disk('public')->size($relativePath),
                'priority' => $priority,
                'file_path' => $relativePath,
                'file_type' => 'image',
                'alt_text' => $file['alt_text'] ?? null,
            ]);
        }
    }

    /**
     * @param mixed $file
     * @param string $filePath
     * @param string $name
     * @return string
     */
    public function getFilename(mixed $file, string $filePath, string $name = 'unknown'): string
    {
        $filename = $name . '_' . time() . '.webp';
        $manager = new ImageManager(new Driver());
        if (!Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->makeDirectory($filePath, 0777, true);
        }
        $image = $manager->read($file);
        $image->toWebp();
        $image->save(storage_path('app/public/' . $filePath . '/' . $filename));
        return $filename;
    }

    public function delete(int $id): bool
    {
        $media = $this->model->query()->find($id);
        if ($media) {
            return $media->delete();
        }
        return false;
    }
}
