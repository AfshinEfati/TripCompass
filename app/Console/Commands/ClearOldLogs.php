<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClearOldLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'حذف لاگ‌های قدیمی‌تر از ۳۰ روز';

    public function handle(): void
    {
        $deleted = DB::table('logs')
            ->where('created_at', '<', Carbon::now()->subDays(30))
            ->delete();

        $this->info("✅ تعداد $deleted لاگ قدیمی حذف شد.");
    }

}
