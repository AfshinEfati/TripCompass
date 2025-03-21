<?php

use App\Jobs\DeleteOldFlightsJob;
use App\Jobs\FetchFlightsJob;


Schedule::job(new FetchFlightsJob())->everyThirtyMinutes();
Schedule::job(new DeleteOldFlightsJob())->hourly();
Schedule::command('logs:clear')->dailyAt('01:00');
Schedule::exec('echo "" > /var/www/parsitrip.com/backend/storage/logs/laravel.log')->dailyAt('01:05');
Schedule::exec('echo "" > /var/www/parsitrip.com/backend/storage/logs/horizon.log')->dailyAt('01:05');
Schedule::exec('echo "" > /var/www/parsitrip.com/backend/storage/logs/queue-worker.log')->dailyAt('01:05');
Schedule::exec('echo "" > /var/www/parsitrip.com/backend/storage/logs/schedule-worker.log')->dailyAt('01:05');
