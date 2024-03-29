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
        $temp = $this->openWeatherService->cityTemperature($city);

        if(!$temp) {
           return $this->errorResponse($this->openWeatherService->message, $this->openWeatherService->statusCode);
        }

        $playlistGenre = genreBasedOnTemp($temp);

        $search = $this->spotifyService->spotifyApi->search($playlistGenre, 'playlist');

        $findedPlaylists =  $search->playlists->items;

        $randomPlaylist = $findedPlaylists[array_rand($findedPlaylists)];

        $playlist = $this->spotifyService->spotifyApi->getPlaylistTracks($randomPlaylist->id);

        $data = [
            'Temperature in ' . ucfirst($city) => $temp,
            'Playlist name' => $randomPlaylist->name,
            'Playlist tracks' => playlistTracksNames($playlist)
        ];

        return $this->successResponse($data);
    }
}
