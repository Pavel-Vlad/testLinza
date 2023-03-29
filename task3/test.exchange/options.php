<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Exchange\Classes\ExchangeRateHelper;

$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);
Loc::loadMessages(__FILE__);

$pairsArray = [];

$aTabs = array(
    array(
        "DIV" => 'edit_content',
        "TAB" => Loc::getMessage("EXCH_OPTIONS_TAB_CONTENT_NAME"),
        "OPTIONS" => array(
            null,
            array(
                "pairs",
                Loc::getMessage("EXCH_PAIRS"),
                null,
                array("selectbox", $pairsArray)
            )
        )
    )
);

if ($request->isPost() && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) {

        foreach ($aTab["OPTIONS"] as $arOption) {

            if (!is_array($arOption)) {

                continue;
            }

            if ($arOption["note"]) {

                continue;
            }

            if ($request["apply"]) {
                $optionValue = $request->getPost($arOption[0]);
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            } elseif ($request["default"]) {
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->GetCurPage() . "?mid=" . $module_id . "&lang=" . LANG);
}


$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs,
    false
);

$tabControl->Begin();

?>
    <form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>"
          method="post">
        <?
        foreach ($aTabs as $k => $aTab) {
            $tabControl->BeginNextTab();
            __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
        }
        $tabControl->Buttons();
        ?>

        <input type="submit" name="apply" value="<? echo(Loc::GetMessage("EXCH_OPTIONS_INPUT_APPLY")); ?>"
               class="adm-btn-save"/>
        <input type="submit" name="default" value="<? echo(Loc::GetMessage("EXCH_OPTIONS_INPUT_DEFAULT")); ?>"/>

        <?
        echo(bitrix_sessid_post());
        ?>

    </form>
<?php
$tabControl->End();
