<?php

namespace App\Repositories\Contracts;

use App\Models\Contract;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Services\AgencyService;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ContractRepository extends BaseRepository implements ContractRepositoryInterface
{
    public function __construct(Contract $model, public AgencyService $agencyService)
    {
        parent::__construct($model);
    }

    public function getByAgencyId(string $agencyId): Contract
    {
        // TODO: Implement getByAgencyId() method.
    }

    public function getByUserId(int $userId): Contract
    {
        // TODO: Implement getByUserId() method.
    }

    /**
     * @throws Exception
     */
    public function createByAgency(array $data): Contract
    {
        $data = (object)$data;
        $agency = $this->agencyService->getByUserId($data->user_id);
        if (!$agency) {
            throw new Exception('this user is not owner of this agency');
        }
        $contract = $this->model->create((array)$data);
        if ($data->hasFile('files')) {
            foreach ($data->files as $file) {
                $contract->files()->create([
                    'file_type' => $file->file_type,
                    'file_path' => $file->store('contracts'),
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_mime_type' => $file->getMimeType(),
                ]);
            }
        }
    }
}
