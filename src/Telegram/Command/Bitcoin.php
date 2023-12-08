<?php

declare(strict_types=1);

namespace App\Telegram\Command;

use App\Utility\Crypto;
use Cake\I18n\FrozenTime;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Response\Message;
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
        $btc = Crypto::getItem('BTC');
        $text = new Message();
        $text
            ->addText('Name: ' . $btc['name'])
            ->addText('Price: $' . number_format((float) $btc['quote']['USD']['price'], 2))
            ->addText('Change 1h: ' . number_format((float) $btc['quote']['USD']['percent_change_1h'], 2) . '%')
            ->addText('Change 24h: ' . number_format((float) $btc['quote']['USD']['percent_change_24h'], 2) . '%')
            ->addText('Change 7d: ' . number_format((float) $btc['quote']['USD']['percent_change_7d'], 2) . '%')
            ->addText('Change 30d: ' . number_format((float) $btc['quote']['USD']['percent_change_30d'], 2) . '%')
            ->addText('Change 60d: ' . number_format((float) $btc['quote']['USD']['percent_change_60d'], 2) . '%')
            ->addText('Change 90d: ' . number_format((float) $btc['quote']['USD']['percent_change_90d'], 2) . '%')
            ->addText('Updated: ' . new FrozenTime($btc['quote']['USD']['last_updated']));

        $update->getChat()->send($text);
    }
}
