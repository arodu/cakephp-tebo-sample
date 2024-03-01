<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use App\Telegram\Traits\Common;
use App\Utility\Crypto;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Update;

class Eth extends BaseCommand
{
    use Common;

    /**
     * @param Chat $chat
     * @param array $originalData
     * @return void
     */
    public function execute(Update $update)
    {
        $eth = Crypto::getItem('ETH');
        $text = $this->getTextResponse($eth);
        $update->getChat()->send($text);
    }
}
