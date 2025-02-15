<?php

use App\Jobs\FetchFlightsJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


Schedule::job(new FetchFlightsJob())->everyThreeHours();
