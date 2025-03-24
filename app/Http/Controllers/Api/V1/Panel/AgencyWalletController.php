<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\AgencyWallet\ChargeRequest;
use App\Http\Resources\Api\Panel\AgencyWalletResource;
use App\Services\AgencyWalletService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class AgencyWalletController extends Controller
{
    use StatusTrait;
    public function __construct(public AgencyWalletService $agencyWalletService){

    }
    public function charge(ChargeRequest $request)
    {
        $charge = $this->agencyWalletService->charge($request->validated());
        return $this->successResponse(AgencyWalletResource::make($charge), 'Charge Successful');
    }
    public function list(){
        $wallets = $this->agencyWalletService->list();
        return $this->successResponse(AgencyWalletResource::collection($wallets), 'Wallets List');
    }
}
