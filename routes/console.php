<?php

use App\Jobs\FetchFlightsJob;


Schedule::job(new FetchFlightsJob())->everyFiveMinutes();
