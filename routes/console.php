<?php

use App\Jobs\DeleteOldFlightsJob;
use App\Jobs\FetchFlightsJob;


Schedule::job(new FetchFlightsJob())->everyFiveMinutes();
Schedule::job(new DeleteOldFlightsJob())->hourly();
