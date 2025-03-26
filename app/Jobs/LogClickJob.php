<?php

namespace App\Jobs;

use App\Models\AgencyService;
use App\Models\ClickLog;
use App\Models\ClickRate;
use App\Models\AgencyWallet;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogClickJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
        $agencyId   = $this->data['agency_id'] ?? null;
        $serviceId  = $this->data['service_id'] ?? null;

        if (!$agencyId || !$serviceId) {
            Log::warning('LogClickJob: داده ناقص برای پردازش کلیک', $this->data);
            return;
        }

        $rate = ClickRate::getRate(serviceId: $serviceId, agencyId: $agencyId);

        if ($rate === null) {
            Log::warning("LogClickJob: نرخ کلیک برای آژانس {$agencyId} و سرویس {$serviceId} پیدا نشد.");
            ClickLog::create(array_merge($this->data, ['rate' => 0]));
            return;
        }

        DB::beginTransaction();
        try {
            $click = ClickLog::create(array_merge($this->data, ['rate' => $rate]));

            $wallet = AgencyWallet::where('agency_id', $agencyId)->lockForUpdate()->first();

            if (!$wallet) {
                Log::error("LogClickJob: ولت برای آژانس {$agencyId} پیدا نشد.");
                DB::rollBack();
                return;
            }

            if ($wallet->balance >= $rate) {
                $wallet->balance -= $rate;
                $wallet->save();

                Transaction::create([
                    'agency_id'   => $agencyId,
                    'wallet_id'   => $wallet->id,
                    'amount'      => -1 * $rate,
                    'type'        => 'click',
                    'description' => 'کسر هزینه بابت کلیک روی سرویس',
                ]);

                Log::info("LogClickJob: {$rate} تومان از آژانس {$agencyId} بابت کلیک کسر شد.");
            } else {
                Log::warning("LogClickJob: اعتبار آژانس {$agencyId} کافی نبود برای کسر {$rate} تومان.");

                // TODO: ثبت تیکت بدهکاری برای آژانس
                // Ticket::create([...])
                $wallet->debt += $rate;
                $wallet->save();
                AgencyService::where('agency_id', $agencyId)->update(['is_active' => false]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("LogClickJob: خطا در پردازش کلیک", [
                'error'      => $e->getMessage(),
                'agency_id'  => $agencyId,
                'service_id' => $serviceId,
            ]);
        }
    }
}
