<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\Core\Configure;
use Cake\Http\Client;

class Crypto
{

    /**
     * @param array $data
     * @return string
     */
    public static function priceOutput(array $data): string
    {
        return '';
    }

    /**
     * @param string $symbol
     * @return array|null
     */
    public static function getItem(string $symbol = 'BTC'): ?array
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

    /**
     * @param array $data
     * @param string $symbol
     * @return array|null
     */
    protected static function getInfo(array $data, string $symbol): ?array
    {
        foreach ($data['data'] as $item) {
            if ($item['symbol'] === $symbol) {
                return $item;
            }
        }

        return null;
    }
}
