<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ExchangeRateService
{

    private static $baseUrl = 'https://openexchangerates.org/api/';

    public static function latest(array $fields = [])
    {
        return self::request('latest.json', $fields);
    }

    /**
     * @param  string  $type
     * @param  array  $fields
     * @return bool|mixed|string
     * @throws GuzzleException
     */
    private static function request($type, $fields)
    {
        $client = new Client(['base_uri' => self::$baseUrl]);
        $response = $client->request(
            'GET',
            $type,
            [
                'json' => $fields,
                'headers' => [
                    'Authorization' => 'Token '.config('currency.api_key')
                ]
            ]
        );
        return json_decode($response->getBody()->getContents(), false);
    }

}
