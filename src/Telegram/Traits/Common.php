<?php

declare(strict_types=1);

namespace App\Telegram\Traits;

use Cake\I18n\FrozenTime;
use Cake\Utility\Hash;
use TeBo\Telegram\Response\Message;

trait Common
{

    /**
     * @param array $item
     * @return \TeBo\Telegram\Response\Message
     */
    protected function getTextResponse(array $item): Message
    {
        $output = [
            __('Name: {0}', $item['name']),
            __('Price: {0}', $this->formatNumber(Hash::get($item, 'quote.USD.price'))),
            __('Change 1h: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_1h'))),
            __('Change 24h: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_24h'))),
            __('Change 7d: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_7d'))),
            __('Change 30d: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_30d'))),
            __('Change 60d: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_60d'))),
            __('Change 90d: {0}%', $this->formatNumber(Hash::get($item, 'quote.USD.percent_change_90d'))),
            __('Updated: {0}', new FrozenTime(Hash::get($item, 'quote.USD.last_updated'))),
        ];

        return new Message($output);
    }

    /**
     * @param float $number
     * @return string
     */
    protected function formatNumber(float $number): string
    {
        return number_format((float) $number, 2);
    }
}
