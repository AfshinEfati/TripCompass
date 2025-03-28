<?php

namespace App\Providers;

use App\Repositories\Contracts\AgencyRepository;
use App\Repositories\Contracts\AgencyServiceRepository;
use App\Repositories\Contracts\AgencyWalletRepository;
use App\Repositories\Contracts\AirlineRepository;
use App\Repositories\Contracts\AirportRepository;
use App\Repositories\Contracts\AnchorRepository;
use App\Repositories\Contracts\BankRepository;
use App\Repositories\Contracts\CabinRepository;
use App\Repositories\Contracts\CityRepository;
use App\Repositories\Contracts\ClickLogRepository;
use App\Repositories\Contracts\ClickRateRepository;
use App\Repositories\Contracts\ClickRateTypeRepository;
use App\Repositories\Contracts\ContentRepository;
use App\Repositories\Contracts\ContractRepository;
use App\Repositories\Contracts\CountryRepository;
use App\Repositories\Contracts\FaqRepository;
use App\Repositories\Contracts\FlightRepository;
use App\Repositories\Contracts\FlightTypeRepository;
use App\Repositories\Contracts\GatewayRepository;
use App\Repositories\Contracts\MediaRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\ProviderRepository;
use App\Repositories\Contracts\SeoRelationRepository;
use App\Repositories\Contracts\SeoRepository;
use App\Repositories\Contracts\ServiceRepository;
use App\Repositories\Contracts\StateRepository;
use App\Repositories\Contracts\TransactionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Interfaces\AgencyRepositoryInterface;
use App\Repositories\Interfaces\AgencyServiceRepositoryInterface;
use App\Repositories\Interfaces\AgencyWalletRepositoryInterface;
use App\Repositories\Interfaces\AirlineRepositoryInterface;
use App\Repositories\Interfaces\AirportRepositoryInterface;
use App\Repositories\Interfaces\AnchorRepositoryInterface;
use App\Repositories\Interfaces\BankRepositoryInterface;
use App\Repositories\Interfaces\CabinRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\ClickLogRepositoryInterface;
use App\Repositories\Interfaces\ClickRateRepositoryInterface;
use App\Repositories\Interfaces\ClickRateTypeRepositoryInterface;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use App\Repositories\Interfaces\FlightRepositoryInterface;
use App\Repositories\Interfaces\FlightTypeRepositoryInterface;
use App\Repositories\Interfaces\GatewayRepositoryInterface;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\SeoRelationRepositoryInterface;
use App\Repositories\Interfaces\SeoRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\StateRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Scopes\OrderByIdDescScope;
use App\Services\AgencyService;
use App\Services\AgencyServiceService;
use App\Services\AgencyWalletService;
use App\Services\AirlineService;
use App\Services\AirportService;
use App\Services\AnchorService;
use App\Services\BankService;
use App\Services\CabinService;
use App\Services\CityService;
use App\Services\ClickLogService;
use App\Services\ClickRateService;
use App\Services\ClickRateTypeService;
use App\Services\ContentService;
use App\Services\ContractService;
use App\Services\CountryService;
use App\Services\FaqService;
use App\Services\FlightService;
use App\Services\FlightTypeService;
use App\Services\GatewayService;
use App\Services\MediaService;
use App\Services\PaymentService;
use App\Services\ProviderService;
use App\Services\SeoRelationService;
use App\Services\SeoService;
use App\Services\ServiceService;
use App\Services\StateService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
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
        // Bind the UserRepositoryInterface with the UserRepository and UserService
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
        // Bind the AgencyRepositoryInterface with the AgencyRepository and AgencyService
        $this->app->bind(ProviderRepositoryInterface::class, ProviderRepository::class);
        $this->app->bind(ProviderService::class, function ($app) {
            return new ProviderService($app->make(ProviderRepositoryInterface::class));
        });
        // Bind the AirlineRepositoryInterface with the AirlineRepository and AirlineService
        $this->app->bind(AirlineRepositoryInterface::class, AirlineRepository::class);
        $this->app->bind(AirlineService::class, function ($app) {
            return new AirlineService($app->make(AirlineRepositoryInterface::class));
        });
        // Bind the AirportRepositoryInterface with the AirportRepository and AirportService
        $this->app->bind(AirportRepositoryInterface::class, AirportRepository::class);
        $this->app->bind(AirportService::class, function ($app) {
            return new AirportService($app->make(AirportRepositoryInterface::class));
        });
        // Bind the SeoServiceInterface with the SeoRepository and SeoService
        $this->app->bind(SeoRepositoryInterface::class, SeoRepository::class);
        $this->app->bind(SeoService::class, function ($app) {
            return new SeoService($app->make(SeoRepositoryInterface::class));
        });
        // Bind SeoRelationRepositoryInterface with SeoRelationRepository and SeoRelationService
        $this->app->bind(SeoRelationRepositoryInterface::class, SeoRelationRepository::class);
        $this->app->bind(SeoRelationService::class, function ($app) {
            return new SeoRelationService($app->make(SeoRelationRepositoryInterface::class));
        });
        // Bind the ContentRepositoryInterface with the ContentRepository and ContentService
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentService::class, function ($app) {
            return new ContentService($app->make(ContentRepositoryInterface::class));
        });
        // Bind the MediaRepositoryInterface with the MediaRepository and MediaService
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
        $this->app->bind(MediaService::class, function ($app) {
            return new MediaService($app->make(MediaRepositoryInterface::class));
        });
        // Bind the FaqRepositoryInterface with the FaqRepository and FaqService
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(FaqService::class, function ($app) {
            return new FaqService($app->make(FaqRepositoryInterface::class));
        });
        // Bind the AnchorRepositoryInterface with the AnchorRepository and AnchorService
        $this->app->bind(AnchorRepositoryInterface::class, AnchorRepository::class);
        $this->app->bind(AnchorService::class, function ($app) {
            return new AnchorService($app->make(AnchorRepositoryInterface::class));
        });
        // Bind AgencyRepositoryInterface with AgencyRepository and AgencyService
        $this->app->bind(AgencyRepositoryInterface::class, AgencyRepository::class);
        $this->app->bind(AgencyService::class, function ($app) {
            return new AgencyService($app->make(AgencyRepositoryInterface::class));
        });
        // Bind the AgencyServiceRepositoryInterface with the AgencyServiceRepository and AgencyServiceService
        $this->app->bind(AgencyServiceRepositoryInterface::class, AgencyServiceRepository::class);
        $this->app->bind(AgencyServiceService::class, function ($app) {
            return new AgencyServiceService($app->make(AgencyServiceRepositoryInterface::class));
        });
        // Bind The FlightRepositoryInterface with the FlightRepository and FlightService
        $this->app->bind(FlightRepositoryInterface::class, FlightRepository::class);
        $this->app->bind(FlightService::class, function ($app) {
            return new FlightService($app->make(FlightRepositoryInterface::class));
        });
        // Bind the ClickLogRepositoryInterface with the ClickLogRepository and ClickLogService
        $this->app->bind(ClickLogRepositoryInterface::class, ClickLogRepository::class);
        $this->app->bind(ClickLogService::class, function ($app) {
            return new ClickLogService($app->make(ClickLogRepositoryInterface::class));
        });
        // Bind the ContractRepositoryInterface with the ContractRepository and ContractService
        $this->app->bind(ContractRepositoryInterface::class, ContractRepository::class);
        $this->app->bind(ContractService::class, function ($app) {
            return new ContractService($app->make(ContractRepositoryInterface::class));
        });
        // Bind the BankRepositoryInterface with the BankRepository and BankService
        $this->app->bind(BankRepositoryInterface::class, BankRepository::class);
        $this->app->bind(BankService::class, function ($app) {
            return new BankService($app->make(BankRepositoryInterface::class));
        });
        // Bind the PaymentRepositoryInterface with the PaymentRepository and PaymentService
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService($app->make(PaymentRepositoryInterface::class));
        });
        // Bind The GatewayRepositoryInterface with the GatewayRepository and GatewayService
        $this->app->bind(GatewayRepositoryInterface::class, GatewayRepository::class);
        $this->app->bind(GatewayService::class, function ($app) {
            return new GatewayService($app->make(GatewayRepositoryInterface::class));
        });
        // Bind the TransactionRepositoryInterface with the TransactionRepository and TransactionService
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService($app->make(TransactionRepositoryInterface::class));
        });
        // Bind the AgencyWalletRepositoryInterface with the AgencyWalletRepository and AgencyWalletService
        $this->app->bind(AgencyWalletRepositoryInterface::class, AgencyWalletRepository::class);
        $this->app->bind(AgencyWalletService::class, function ($app) {
            return new AgencyWalletService($app->make(AgencyWalletRepositoryInterface::class));
        });
        // Bind the CabinRepositoryInterface with the CabinRepository and CabinService
        $this->app->bind(CabinRepositoryInterface::class, CabinRepository::class);
        $this->app->bind(CabinService::class, function ($app) {
            return new CabinService($app->make(CabinRepositoryInterface::class));
        });
        $this->app->bind(FlightTypeRepositoryInterface::class, FlightTypeRepository::class);
        $this->app->bind(FlightTypeService::class, function ($app) {
            return new FlightTypeService($app->make(FlightTypeRepositoryInterface::class));
        });
        $this->app->bind(ClickRateTypeRepositoryInterface::class, ClickRateTypeRepository::class);
        $this->app->bind(ClickRateTypeService::class, function ($app) {
            return new ClickRateTypeService($app->make(ClickRateTypeRepositoryInterface::class));
        });
        $this->app->bind(ClickRateRepositoryInterface::class, ClickRateRepository::class);
        $this->app->bind(ClickRateService::class, function ($app) {
           return new ClickRateService($app->make(ClickRateRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::addGlobalScope(new OrderByIdDescScope());

    }

}
