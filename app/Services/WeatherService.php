<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService implements WeatherServiceInterface
{
    private $key = "";
    private $link = "";
    private $city = "omsk";
    private $client;

    public function __construct()
    {
        $this->key = $this->getKey();
        $this->link = $this->getLink();
        $this->client = new Client();
        $this->client = new Client([
            'base_uri' => 'http://api.openweathermap.org/data/2.5/',
        ]);
    }

    /**
     * Set key variable as key API openwatermap.com from environment.
     * @return string
     */
    private function getKey()
    {
        return config('app.api_weather_key');
    }

    private function getLink() : string
    {
        return config('app.api_weather_link');
    }

    public function getData()
    {
        $response = $this->client->request('GET', 'find', [
            'query' => [
                'q' => $this->city,
                'APPID' => $this->key,
            ],
        ]);
        if($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();

        }
        return $response->getStatusCode();
    }
}