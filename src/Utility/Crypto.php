<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\Core\Configure;
use Cake\Http\Client;

class Crypto
{

    public static function output($info): string
    {
        return '';
    }

    public static function getItem($symbol = 'BTC')
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => Configure::read('CoinMarketCapApiKey'),
        ];
        $qs = [
            //'start' => '1',
            //'limit' => '5000',
            'convert' => 'USD'
        ];

        $request = [
            'headers' => $headers,
        ];

        $client = new Client();
        $response = $client->get($url, $qs, $request);
        $data = $response->getJson();
        return static::getInfo($data, $symbol);
    }

    protected static function getInfo($data, $symbol)
    {
        foreach ($data['data'] as $item) {
            if ($item['symbol'] === $symbol) {
                return $item;
            }
        }

        return null;
    }
}
