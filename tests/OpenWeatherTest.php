<?php


class OpenWeatherTest extends TestCase
{
    public $client;

    public $cityWeather;

    protected function setUp(): void
    {
        parent::setUp();
        $baseURI = "http://api.openweathermap.org/data/2.5/";
        $this->client = new \GuzzleHttp\Client([
            "base_uri" => $baseURI
        ]);
    }

    /** @test */
    public function it_returns_valid_json_city_weather()
    {
        $city = "dallol";
        $response = $this->client->request('GET', "weather?q={$city}&appid=" . env('OPEN_WEATHER_APP_ID'));

        $this->assertTrue($response->getStatusCode() === 200);
        $this->assertJson($response->getBody()->getContents());
        $this->cityWeather = json_decode($response->getBody()->getContents());
    }

    /** @depends it_returns_valid_json_city_weather */
    public function it_returns_valid_city_temp()
    {
        $cityWeather = $this->cityWeather;

        $this->assertIsObject($cityWeather);
        $this->assertObjectHasAttribute('main', $cityWeather);
        $this->assertIsNumeric($cityWeather->main->temp);
    }
}
