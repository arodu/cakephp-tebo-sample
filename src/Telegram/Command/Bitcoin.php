<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use Cake\Core\Configure;
use Cake\Utility\Hash;
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

    public function getBitcoinPrice()
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

        $client = new \Cake\Http\Client();
        $response = $client->get($url, $qs, $request);
        $data = $response->getJson();

        $price = Hash::get($data, 'data.0.quote.USD.price');
        return $price;
    }
}
