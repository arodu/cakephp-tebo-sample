<?php

declare(strict_types=1);

namespace App\Telegram\Command;

use App\Telegram\Traits\Common;
use App\Utility\Crypto;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Update;

class Bitcoin extends BaseCommand
{
    use Common;

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
        $text = $this->getTextResponse($btc);
        $update->getChat()->send($text);
    }
}
