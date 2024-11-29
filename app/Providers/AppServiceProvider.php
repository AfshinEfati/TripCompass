<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
    protected function registerRepositories(): void
    {
        $interfacesPath = app_path('Repositories/Interfaces');
        $contractsPath = app_path('Repositories/Contracts');
        if (File::exists($interfacesPath) && File::exists($contractsPath)) {
            $interfaceFiles = File::allFiles($interfacesPath);
            foreach ($interfaceFiles as $interfaceFile) {
                $interfaceClass = 'App\\Repositories\\Interfaces\\' . $interfaceFile->getFilenameWithoutExtension();
                if (interface_exists($interfaceClass)) {
                    $contractClass = str_replace('Interfaces', 'Contracts', $interfaceClass);
                    if (class_exists($contractClass)) {
                        $this->app->bind($interfaceClass, $contractClass);
                    }
                }
            }
        }
    }

    protected function registerServices(): void
    {
        $servicePath = app_path('Services');
        if (File::exists($servicePath)) {
            $files = File::allFiles($servicePath);
            foreach ($files as $file) {
                $class = 'App\\Services\\' . $file->getFilenameWithoutExtension();
                if (class_exists($class)) {
                    $this->app->singleton($class);
                }
            }
        }
    }
}
