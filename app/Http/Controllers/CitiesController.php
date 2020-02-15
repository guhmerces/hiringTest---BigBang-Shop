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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SpotifyService $spotifyService, OpenWeatherService $openWeatherService)
    {
        $this->spotifyService = $spotifyService;
        $this->openWeatherService = $openWeatherService;
    }

    public function show($city)
    {
        $temp = $this->openWeatherService->cityCelsiusTemp($city);

        if($this->openWeatherService->errorCode) {
           return $this->errorResponse($this->openWeatherService->message, $this->openWeatherService->errorCode);
        }

        $playlistID = playlistBasedOnTemp($temp);
        $playlist = $this->spotifyService->spotifyApi->getPlaylistTracks($playlistID);

        return $this->successResponse(playlistTracksNames($playlist));
    }
}
