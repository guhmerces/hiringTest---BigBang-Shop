<?php

class SpotifyTest extends TestCase
{
    protected $spotifyApi;

    protected $spotifyClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->spotifyClient = new SpotifyWebAPI\Session(env('SPOTIFY_CLIENT_ID'), env('SPOTIFY_CLIENT_SECRET'));
        $this->spotifyApi = new SpotifyWebAPI\SpotifyWebAPI();

        $this->spotifyClient->requestCredentialsToken();
        $this->spotifyApi->setAccessToken($this->spotifyClient->getAccessToken());
    }

    /** @test */
    public function it_returns_valid_playlist_tracks_names()
    {
        $playlistID = "5ggSdArYBwNDU95ePtnPYG";

        $playlist = $this->spotifyApi->getPlaylistTracks($playlistID);

        $this->assertObjectHasAttribute('items', $playlist);
        $this->assertIsArray($playlist->items);
        $this->assertNotEmpty($playlist->items);
    }
}
