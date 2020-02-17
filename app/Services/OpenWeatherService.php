<?php

namespace App\Services;

use App\Traits\Message;

class OpenWeatherService extends ConsumeExternalServices
{
    use Message;

    public function __construct()
    {
        $this->baseURI = "http://api.openweathermap.org/data/2.5/";
        $this->setStatusMessages();
    }

    public function cityTemp(string $city)
    {
        $cityWeather = json_decode($this->cityWeather($city));

        //set a personalized status message according to the statusCode
        $this->message($this->statusCode);

        if ($this->statusCode != 200) {
            return null;
        }

        return $cityWeather->main->temp;
    }

    private function cityWeather(string $city)
    {
        return $this->makeRequest('GET', "weather?q={$city}&appid=" . env('OPEN_WEATHER_APP_ID'));
    }

    private function setStatusMessages()
    {
        $statusMessages = [
            '200' => '',
            '401' => 'Api Key Inválida. Veja http://openweathermap.org/faq#error401 para mais informações.',
            '404' => 'Cidade não encontrada',
            '429' => 'Você atingiu o limite de requisições no OpenWeather.',
        ];

        $this->statusMessages = $statusMessages;
    }
}
