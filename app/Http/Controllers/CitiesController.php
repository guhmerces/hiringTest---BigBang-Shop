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

    public function __construct(SpotifyService $spotifyService, OpenWeatherService $openWeatherService)
    {
        $this->spotifyService = $spotifyService;
        $this->openWeatherService = $openWeatherService;
    }

    public function show($city)
    {
        $temp = $this->openWeatherService->cityTemp($city);
        $temp = kelvinToCelsius($temp);

        if($this->openWeatherService->statusCode != 200) {
           return $this->errorResponse($this->openWeatherService->message, $this->openWeatherService->statusCode);
        }

        $playlistID = playlistBasedOnTemp($temp);
        $playlist = $this->spotifyService->spotifyApi->getPlaylistTracks($playlistID);

        return $this->successResponse(playlistTracksNames($playlist));
    }
}
