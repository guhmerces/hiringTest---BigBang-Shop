<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ConsumeExternalServices
{
    public $baseURI;

    public $statusCode;

    public function makeRequest($verb, $uri)
    {
        $client = new Client([
            "base_uri" => $this->baseURI
        ]);

        try {
            $response = $client->request($verb, $uri);
            $this->statusCode = '200';
        } catch (ClientException $exception) {
            $this->statusCode = $exception->getCode();
            return null;
        }

        return $response->getBody()->getContents();
    }
}
