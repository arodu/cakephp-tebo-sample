<?php
declare(strict_types=1);

namespace App\Telegram\Command;

use TeBo\Telegram\Command\BaseCommand;
use TeBo\Telegram\Response\ResponseText;
use TeBo\Telegram\Update;

class Start extends BaseCommand
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
        $update->getChat()->send(new ResponseText('Custom start command!'));
    }
}
