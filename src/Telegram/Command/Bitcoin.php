<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use Cake\Core\Configure;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Response\Text;
use TeBo\Telegram\Update;

class Bitcoin extends BaseCommand
{
    public function help()
    {
    }

    /**
     * @param Chat $chat
     * @param array $originalData
     * @return void
     */
    public function execute(Update $update)
    {
        $price = $this->getBitcoinPrice();
        $update->getChat()->send(new Text('The current price of bitcoin is $' . $price));

        //$update->getChat()->send(new Text('Custom start command!'));
    }


    // method to find the price of bitcoin by the coinmarketcap v2 api, returns the price in USD, user CakeHttp from Cakephp
    public function getBitcoinPrice()
    {
        $url = 'https://pro-api.coinmarketcap.com/v2/ticker/1/?convert=USD';
        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . Configure::read('CoinMarketCapApiKey'),
        ];
        $qs = [
            'start' => '1',
            'limit' => '5000',
            'convert' => 'USD'
        ];

        $request = [
            'headers' => $headers,
            'qs' => $qs
        ];

        $client = new \Cake\Http\Client();
        $response = $client->get($url, $request);
        $data = $response->getJson();
        $price = $data['data']['quotes']['USD']['price'];
        return $price;
    }
}
