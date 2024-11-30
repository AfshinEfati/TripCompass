<?php

namespace App\Providers;

use App\Repositories\Contracts\CityRepository;
use App\Repositories\Contracts\CountryRepository;
use App\Repositories\Contracts\ServiceRepository;
use App\Repositories\Contracts\StateRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\StateRepositoryInterface;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\ServiceService;
use App\Services\StateService;
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
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(StateService::class, function ($app) {
            return new StateService($app->make(StateRepositoryInterface::class));
        });
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CityService::class, function ($app) {
            return new CityService($app->make(CityRepositoryInterface::class));
        });
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceService::class, function ($app) {
            return new ServiceService($app->make(ServiceRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

}
