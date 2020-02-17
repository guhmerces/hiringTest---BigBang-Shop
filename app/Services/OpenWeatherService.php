<?php

namespace App\Services;

use App\Traits\Message;

class OpenWeatherService extends ConsumeExternalServices
{
    use Message;

    /**
     * OpenWeatherService constructor.
     */
    public function __construct()
    {
        $this->baseURI = "http://api.openweathermap.org/data/2.5/";
        $this->defineStatusMessages();
    }

    public function cityTemperature(string $city)
    {
        $cityWeather = json_decode($this->cityWeather($city));

        $this->message($this->statusCode);

        return $cityWeather->main->temp ?? null;
    }

    public function celsiusTemperature(string $city)
    {
        return kelvinToCelsius($this->cityTemperature($city));
    }

    private function cityWeather(string $city)
    {
        $cityWeather = $this->makeRequest('GET', "weather?q={$city}&appid=" . env('OPEN_WEATHER_APP_ID'));

        return $cityWeather ?? null;
    }

    private function defineStatusMessages()
    {
        $statusMessages = [
            '200' => '',
            '401' => 'Api Key Inválida. Veja http://openweathermap.org/faq#error401 para mais informações.',
            '404' => 'Cidade não encontrada.',
            '429' => 'Você atingiu o limite de requisições no OpenWeather.',
        ];

        $this->setStatusMessages($statusMessages);
    }
}
