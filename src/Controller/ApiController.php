<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use App\Utility\Crypto;
use Cake\I18n\FrozenTime;

/**
 * V1 Controller
 *
 * @method \App\Model\Entity\V1[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{

    /**
     * @param string $currency
     * @return void
     */
    public function price(string $currency)
    {
        $crypto = Crypto::getItem($currency);
        $this->set('price', $crypto['quote']['USD']['price']);
    }

    /**
     * @param string $currency
     * @return void
     */
    public function lastUpdated(string $currency)
    {
        $crypto = Crypto::getItem($currency);
        $lastUpdated = new FrozenTime($crypto['quote']['USD']['last_updated']);
        $this->set('lastUpdated', $lastUpdated);
    }
}
