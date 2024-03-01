<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use App\Telegram\Traits\Common;
use App\Utility\Crypto;
use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Update;

class Solana extends BaseCommand
{
    use Common;

    /**
     * @param Update $update
     * @return void
     */
    public function execute(Update $update)
    {
        $sol = Crypto::getItem('SOL');
        $text = $this->getTextResponse($sol);
        $update->getChat()->send($text);
    }
}
