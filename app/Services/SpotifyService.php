<?php

namespace App\Services;

use SpotifyWebAPI;

class SpotifyService
{
    public $spotifyApi;

    public function __construct(SpotifyWebAPI\Session $spotifyClient, SpotifyWebAPI\SpotifyWebAPI $spotifyApi)
    {
        try {
            $spotifyClient->requestCredentialsToken();
        } catch (SpotifyWebAPI\SpotifyWebAPIAuthException $exception) {
            die("Spotify API : " . $exception->getMessage() . " - error " . $exception->getCode());
        }

        $this->spotifyApi = $spotifyApi;
        $this->spotifyApi->setAccessToken($spotifyClient->getAccessToken());
    }
}
