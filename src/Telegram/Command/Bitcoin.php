<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
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
        $text = new Text('');

        $text->addText('Name: ' . $btc['name']);
        $text->addText('Price: $' . number_format((float) $btc['quote']['USD']['price'], 2));
        $text->addText('Change 1h: ' . number_format((float) $btc['quote']['USD']['percent_change_1h'], 2)) . '%';
        $text->addText('Change 24h: ' . number_format((float) $btc['quote']['USD']['percent_change_24h'], 2)) . '%';
        $text->addText('Change 7d: ' . number_format((float) $btc['quote']['USD']['percent_change_7d'], 2)) . '%';
        $text->addText('Change 30d: ' . number_format((float) $btc['quote']['USD']['percent_change_30d'], 2)) . '%';
        $text->addText('Change 60d: ' . number_format((float) $btc['quote']['USD']['percent_change_60d'], 2)) . '%';
        $text->addText('Change 90d: ' . number_format((float) $btc['quote']['USD']['percent_change_90d'], 2)) . '%';
        $text->addText('Updated: ' . new FrozenTime('2023-01-22T17:07:00.000Z'));

        $update->getChat()->send($text);
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

/*

'id' => (int) 1,
'name' => 'Bitcoin',
'symbol' => 'BTC',
'slug' => 'bitcoin',
'num_market_pairs' => (int) 9942,
'date_added' => '2013-04-28T00:00:00.000Z',
'tags' => [
(int) 0 => 'mineable',
(int) 1 => 'pow',
(int) 2 => 'sha-256',
(int) 3 => 'store-of-value',
(int) 4 => 'state-channel',
(int) 5 => 'coinbase-ventures-portfolio',
(int) 6 => 'three-arrows-capital-portfolio',
(int) 7 => 'polychain-capital-portfolio',
(int) 8 => 'binance-labs-portfolio',
(int) 9 => 'blockchain-capital-portfolio',
(int) 10 => 'boostvc-portfolio',
(int) 11 => 'cms-holdings-portfolio',
(int) 12 => 'dcg-portfolio',
(int) 13 => 'dragonfly-capital-portfolio',
(int) 14 => 'electric-capital-portfolio',
(int) 15 => 'fabric-ventures-portfolio',
(int) 16 => 'framework-ventures-portfolio',
(int) 17 => 'galaxy-digital-portfolio',
(int) 18 => 'huobi-capital-portfolio',
(int) 19 => 'alameda-research-portfolio',
(int) 20 => 'a16z-portfolio',
(int) 21 => '1confirmation-portfolio',
(int) 22 => 'winklevoss-capital-portfolio',
(int) 23 => 'usv-portfolio',
(int) 24 => 'placeholder-ventures-portfolio',
(int) 25 => 'pantera-capital-portfolio',
(int) 26 => 'multicoin-capital-portfolio',
(int) 27 => 'paradigm-portfolio',
],
'max_supply' => (int) 21000000,
'circulating_supply' => (int) 19269400,
'total_supply' => (int) 19269400,
'platform' => null,
'cmc_rank' => (int) 1,
'self_reported_circulating_supply' => null,
'self_reported_market_cap' => null,
'tvl_ratio' => null,
'last_updated' => '2023-01-22T17:07:00.000Z',
'quote' => [
'USD' => [
'price' => (float) 22837.624877995,
'volume_24h' => (float) 24378097979.714,
'volume_change_24h' => (float) -34.4125,
'percent_change_1h' => (float) 0.30225204,
'percent_change_24h' => (float) -1.63337434,
'percent_change_7d' => (float) 9.26615628,
'percent_change_30d' => (float) 35.63541998,
'percent_change_60d' => (float) 39.57228574,
'percent_change_90d' => (float) 18.44818006,
'market_cap' => (float) 440067328824.03,
'market_cap_dominance' => (float) 42.0333,
'fully_diluted_market_cap' => (float) 479590122437.89,
'tvl' => null,
'last_updated' => '2023-01-22T17:07:00.000Z',
],
],
]
 * 
 */
