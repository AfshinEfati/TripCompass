<?php
namespace App\Services\Agency;

use App\Models\AgencyService;
use App\Models\AgencyRoute;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class FetchAgencyDataService {
    public function fetchAllFlights(): string
    {
        $services = AgencyService::where('service_id', 1)->get();

        foreach ($services as $service) {
            $vendor = $service->vendor;
            $vendorClass = "App\\Services\\Agency\\Vendors\\{$vendor}\\{$vendor}Service";

            if (!class_exists($vendorClass)) {
                \Log::error("Vendor class {$vendorClass} not found for agency {$service->agency_id}");
                continue;
            }

            $config = $service->config;
            $vendorInstance = new $vendorClass($config);

            // دریافت مسیرهای پروازی مرتبط با این آژانس
            $routes = AgencyRoute::where('agency_id', $service->agency_id)->get();

            foreach ($routes as $route) {
                $origin = $route->origin_id;
                $destination = $route->destination_id;
                $today = Carbon::today();

                for ($i = 0; $i < 7; $i++) { // گرفتن اطلاعات پرواز یک هفته آینده
                    $flightDate = $today->copy()->addDays($i)->toDateString();

                    // ساختن بدنه درخواست POST
                    $requestData = [
                        'origin' => $origin,
                        'destination' => $destination,
                        'date' => $flightDate,
                        'flight_type' => 'one_way', // فعلاً فقط یک‌طرفه
                        'passengers' => [
                            'ADT' => 1, // همیشه یک نفر بزرگسال
                            'CHD' => 0, // بدون کودک
                            'INF' => 0  // بدون نوزاد
                        ]
                    ];

                    // ارسال درخواست به API آژانس
                    $data = $vendorInstance->fetchFlights($requestData);

                    if ($data) {
                        $cacheKey = "flights_{$service->agency_id}_{$origin}_{$destination}_{$flightDate}";
                        Cache::put($cacheKey, $data, now()->addMinutes(30));
                    }
                }
            }
        }

        return "All flights fetched for the next week.";
    }
}
