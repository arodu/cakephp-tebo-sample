<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use App\Utility\Crypto;
use Cake\I18n\FrozenTime;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Response\Text;
use TeBo\Telegram\Update;

class Eth extends BaseCommand
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
        $btc = Crypto::getItem('ETH');
        $text = new Text('');

        $text->addText('Name: ' . $btc['name']);
        $text->addText('Price: $' . number_format((float) $btc['quote']['USD']['price'], 2));
        $text->addText('Change 1h: ' . number_format((float) $btc['quote']['USD']['percent_change_1h'], 2) . '%');
        $text->addText('Change 24h: ' . number_format((float) $btc['quote']['USD']['percent_change_24h'], 2) . '%');
        $text->addText('Change 7d: ' . number_format((float) $btc['quote']['USD']['percent_change_7d'], 2) . '%');
        $text->addText('Change 30d: ' . number_format((float) $btc['quote']['USD']['percent_change_30d'], 2) . '%');
        $text->addText('Change 60d: ' . number_format((float) $btc['quote']['USD']['percent_change_60d'], 2) . '%');
        $text->addText('Change 90d: ' . number_format((float) $btc['quote']['USD']['percent_change_90d'], 2) . '%');
        
        $text->addText('Updated: ' . new FrozenTime($btc['quote']['USD']['last_updated']));

        $update->getChat()->send($text);
    }
}

