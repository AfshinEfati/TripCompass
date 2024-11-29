<?php

namespace App\Providers;

use App\Repositories\Contracts\CountryRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Services\CountryService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CountryService::class, function ($app) {
            return new CountryService($app->make(CountryRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

}
