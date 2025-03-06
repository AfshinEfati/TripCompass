<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Contract\CreateContractRequest;
use App\Models\Contract;
use App\Services\ContractService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    use StatusTrait;
    public function __construct(public ContractService $service)
    {
    }

    public function index()
    {

    }

    public function store(CreateContractRequest $request)
    {
        $contract = $this->service->createByAgency($request->validated());
        return $this->successResponse($contract, 'Contract created successfully');
    }

    public function show(Contract $contract)
    {
    }

    public function update(Request $request, Contract $contract)
    {
    }

    public function destroy(Contract $contract)
    {
    }
}
