<?php

namespace Exchange\Classes;

use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Config\Option;


class ExchangeRateHelper
{
    public static function getData(string $endpoint, array $otherParams = [], string $method = 'GET'): array
    {
        $api_key = Option::get('test.exchange', 'apikey', '7e793671f37c0b385d646d49a9959d9b');
        $httpClient = new HttpClient();
        $otherParams = http_build_query($otherParams);
        $queryStr = 'https://currate.ru/api/?get=' . $endpoint . '&key=' . $api_key . '&' . $otherParams;
        $httpClient->query($method, $queryStr);
        $pairs = Json::decode($httpClient->getResult());

        return $pairs['data'];
    }
}