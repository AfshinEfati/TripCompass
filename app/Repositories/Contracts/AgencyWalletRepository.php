<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\AgencyWalletRepositoryInterface;
use App\Models\AgencyWallet;
use App\Repositories\BaseRepository;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyWalletRepository extends BaseRepository implements AgencyWalletRepositoryInterface
{
    public function __construct(AgencyWallet $model, public TransactionService $transactionService)
    {
        parent::__construct($model);
    }

    public function charge(mixed $validated)
    {
        $user = auth()->user();

        $wallet = $this->model->firstOrNew([
            'agency_id' => $validated['agency_id'],
        ]);

        $amount = $validated['amount'];
        $debt = $wallet->debt ?? 0;
        $usedForDebt = 0;

        // اگر بدهی وجود داشته باشه، اول از شارژ کم می‌کنیم
        if ($debt > 0) {
            if ($amount >= $debt) {
                $usedForDebt = $debt;
                $wallet->debt = 0;
            } else {
                $usedForDebt = $amount;
                $wallet->debt -= $amount;
            }
        }

        // مبلغ باقی‌مانده به balance اضافه می‌شه
        $wallet->balance = ($wallet->balance ?? 0) + ($amount - $usedForDebt);
        $wallet->save();

        // کسر از ولت کاربر (سیستم داخلی شما)
        $user->update(['balance' => $user->balance - $amount]);

        // ثبت تراکنش برای شارژ
        $this->transactionService->store([
            'user_id'     => $user->id,
            'amount'      => $amount,
            'type'        => 'withdraw',
            'agency_id'   => $validated['agency_id'],
            'wallet_id'   => $wallet->id,
            'description' => "شارژ کیف پول آژانس {$wallet->agency->name_fa}"
        ]);

        // اگر بخشی از مبلغ صرف تسویه بدهی شده، تراکنش جدا ثبت بشه
        if ($usedForDebt > 0) {
            $this->transactionService->store([
                'user_id'     => $user->id,
                'amount'      => -1 * $usedForDebt,
                'type'        => 'debt_payment',
                'agency_id'   => $validated['agency_id'],
                'wallet_id'   => $wallet->id,
                'description' => "تسویه بدهی آژانس از محل شارژ جدید"
            ]);
        }

        return $wallet;
    }


    public function list()
    {
        $agencyIds = auth()->user()->agencies()->pluck('id');

        return $this->model
            ->with(['agency', 'transactions'])
            ->whereIn('agency_id', $agencyIds)
            ->get();
    }
}
