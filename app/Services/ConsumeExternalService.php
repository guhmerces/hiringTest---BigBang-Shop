<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ConsumeExternalServices
{
    public $baseURI;

    public $errorCode;

    public function makeRequest($verb, $uri)
    {
        $client = new Client([
            "base_uri" => $this->baseURI
        ]);

        try {
            $response = $client->request($verb, $uri);
        } catch (ClientException $exception) {
            $this->errorCode = $exception->getCode();
            return null;
        }

        return $response->getBody()->getContents();
    }
}
