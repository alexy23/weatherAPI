<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class ForecastController extends Controller
{
    public function forecast(WeatherService $weather)
    {
        $weatherData = $weather->getData();
        return $weatherData;
    }
}
