<?php
declare(strict_types=1);

namespace App\TeBo;

use TeBo\Telegram\Chat;
use TeBo\Telegram\Command\CommandInterface;
use TeBo\Telegram\Message\TextMessage;

class Log implements CommandInterface
{
    public function help()
    {
    }

    /**
     * @param Chat $chat
     * @param array $originalData
     * @return void
     */
    public function execute(Chat $chat, array $originalData)
    {
        $chat->send(new TextMessage('Hello World from TeBo!'));
    }
}
