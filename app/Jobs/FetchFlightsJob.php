<?php

namespace App\Jobs;

use App\Models\AgencyService;
use App\Services\Agency\FetchAgencyDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class FetchFlightsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3; // جاب ۳ بار تلاش می‌کند
    public int $backoff = 10; // بین هر تلاش ۱۰ ثانیه صبر می‌کند
    public int $timeout = 300; // حداکثر زمان اجرای جاب

    /**
     * @throws Throwable
     */
    public function handle(FetchAgencyDataService $fetchService): void
    {
        try {
            \Log::info('Start Job');
            $fetchService->fetchAllFlights();
        } catch (\Throwable $e) {
            \Log::error("❌ FetchFlightsJob Failed: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            if ($this->isServerError($e)) {
                $this->fail($e);
                return;
            }
            throw $e;
        }
    }

    private function isServerError(\Throwable $e): bool
    {
        $serverErrors = [
            'timed out', 'Connection refused', '503 Service Unavailable',
            '500 Internal Server Error', '502 Bad Gateway', '504 Gateway Timeout'
        ];
        foreach ($serverErrors as $error) {
            if (str_contains($e->getMessage(), $error)) {
                return true;
            }
        }
        return false;
    }
}

