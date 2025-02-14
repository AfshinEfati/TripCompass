<?php

namespace App\Services\Agency;

interface VendorAPI
{
    public function fetchFlights(array $requestData);

    public function fetchHotels();
}
