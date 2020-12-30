<?php


namespace App\Helpers;


use GuzzleHttp\Client;

class RequestApiHelper
{
    public static function get($url)
    {
        $client = new Client(['timeout' => 2.0]);
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            return 'error';
        }

        return $response->getBody();
    }
}
