<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use App\Services\SpotifyService;
use App\Traits\ApiResponser;

class CitiesController extends Controller
{
    use ApiResponser;

    public $spotifyService;

    public $openWeatherService;

    /**
     * CitiesController constructor.
     * @param SpotifyService $spotifyService
     * @param OpenWeatherService $openWeatherService
     */
    public function __construct(SpotifyService $spotifyService, OpenWeatherService $openWeatherService)
    {
        $this->spotifyService = $spotifyService;
        $this->openWeatherService = $openWeatherService;
    }

    /**
     * Returns some playlist tracks according to the temperature of a given city
     * @param $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($city)
    {
        $temp = $this->openWeatherService->celsiusTemperature($city);

        if($this->openWeatherService->statusCode != 200) {
           return $this->errorResponse($this->openWeatherService->message, $this->openWeatherService->statusCode);
        }

        $playlistID = playlistBasedOnTemp($temp);
        $playlist = $this->spotifyService->spotifyApi->getPlaylistTracks($playlistID);

        return $this->successResponse(playlistTracksNames($playlist));
    }
}
