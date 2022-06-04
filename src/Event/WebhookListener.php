<?php
namespace App\Event;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\Log\Log;
use TeBo\TeBo;

class WebhookListener implements EventListenerInterface
{
    public function implementedEvents(): array
    {
        return [
            TeBo::EVENT_NEW_UPDATE => 'logNewUpdate',
        ];
    }

    public function logNewUpdate(Event $event)
    {
        $data = $event->getSubject()->getOriginalData();
        Log::debug(json_encode($data));
    }
}
