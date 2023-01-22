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
        $btc = $this->getItem();

        //dd($btc);

        $update->getChat()->send(new Text('The current price of bitcoin is $' . $btc['quote']['USD']['price']));
        $update->getChat()->send(new Text('Custom start command!'));
    }

    public function getItem()
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
        return $this->getInfo($data, 'BTC');
    }

    protected function getInfo($data, $symbol)
    {
        foreach ($data['data'] as $item) {
            if ($item['symbol'] === $symbol) {
                return $item;
            }
        }

        return null;
    }


}
