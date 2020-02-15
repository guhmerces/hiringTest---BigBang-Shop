<?php

namespace App\Services;

use App\Services\ConsumeExternalServices;
use GuzzleHttp\Exception\ClientException;

class OpenWeatherService extends ConsumeExternalServices
{
    public $message;

    public function __construct()
    {
        $this->baseURI = "http://api.openweathermap.org/data/2.5/";
    }

    public function cityCelsiusTemp(string $city)
    {
        $cityWeather = json_decode($this->cityWeather($city));

        if($this->errorCode) {
            $this->message();
            return null;
        }

        return kelvinToCelsius($cityWeather->main->temp);
    }

    private function cityWeather(string $city)
    {
        return $this->makeRequest('GET', "weather?q={$city}&appid=" . env('OPEN_WEATHER_APP_ID'));
    }

    private function message()
    {
        if ($this->errorCode === 401) {
            $this->message = 'Api Key Inválida. Veja http://openweathermap.org/faq#error401 para mais informações.';

        } elseif ($this->errorCode === 404) {
            $this->message = "Cidade não encontrada";

        } elseif ($this->errorCode === 429) {
            $this->message = "Você atingiu o limite de requisições";
        }
    }
}
