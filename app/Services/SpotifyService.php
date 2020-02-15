<?php

namespace App\Services;

use SpotifyWebAPI;

class SpotifyService
{
    public $spotifyApi;

    public function __construct(SpotifyWebAPI\Session $spotifyClient, SpotifyWebAPI\SpotifyWebAPI $spotifyApi)
    {
        $this->spotifyApi = $spotifyApi;

        $spotifyClient->requestCredentialsToken();
        
        $this->spotifyApi->setAccessToken($spotifyClient->getAccessToken());        
    }
}