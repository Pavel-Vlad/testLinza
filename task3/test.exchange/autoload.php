<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'test.exchange',
    array(
        'Exchange\Classes\ExchangeRateHelper' => 'classes/ExchangeRateHelper.php'
    )
);