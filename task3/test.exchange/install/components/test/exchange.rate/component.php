<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Exchange\Classes\ExchangeRateHelper;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;


if (!Loader::includeModule('test.exchange'))
    return;

$pairs = Option::get('test.exchange', 'pairs');
$rates = ExchangeRateHelper::getData('rates', ['pairs' => $pairs]);
$arResult['EXCHANGE_RATES'] = $rates;

$this->IncludeComponentTemplate();
?>