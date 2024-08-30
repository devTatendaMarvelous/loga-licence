<?php

namespace Marvelous\Licence\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class ApiService
{

    public static function get($endpoint)
    {

        try {
            $client = new Client();
            $response = $client ->request('GET', $endpoint);
            $data = json_decode($response->getBody(), false);
            return $data;
        } catch (RequestException $e) {
            return null;
        }
    }

    public static function post($endpoint)
    {
        try {
            $client = new Client();
            $response = $client ->request('POST', $endpoint);
            $data = json_decode($response->getBody(), false);
            return $data;
        } catch (RequestException $e) {
            return null;
        }
    }
}
