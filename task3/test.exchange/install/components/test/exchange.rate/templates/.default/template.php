<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (empty($arResult['EXCHANGE_RATES'])) return;
?>
<h3>Курс валют</h3>
<ul style="list-style: none">
    <?php
    foreach ($arResult['EXCHANGE_RATES'] as $pair => $rate) {
        $pair = substr($pair, 0, 3) . '/' . substr($pair, 3);
        $rate = round($rate, 2);
        echo '<li>' . $pair . '  <b>' . $rate . '</b></li>';
    }
    ?>
</ul>
