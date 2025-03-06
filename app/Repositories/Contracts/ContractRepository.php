<?php

namespace App\Repositories\Contracts;

use App\Models\Contract;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Services\AgencyService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;


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
     * @throws Exception|Throwable
     */
    public function createByAgency(array $data)
    {
        DB::beginTransaction();
        try {
            $data = (object)$data;
            $agency = $this->agencyService->getByUserId($data->user_id);
            if (!$agency) {
                throw new Exception('this user is not owner of this agency');
            }
            $contract = $this->model->create((array)$data);
            if (!empty($data->files)) {
                foreach ($data->files as $file) {
                    $file= (object)$file;
                    $contract->files()->create([
                        'file_type' => $file->file_type,
                        'file_path' => $file->file->store('contracts'),
                        'file_name' => $file->file->getClientOriginalName(),
                        'file_size' => $file->file->getSize(),
                        'file_mime_type' => $file->file->getMimeType(),
                    ]);
                }
            }
            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
