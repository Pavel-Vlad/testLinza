<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("EXCH_SHOW_RATES_COMPONENT_NAME"),
    "DESCRIPTION" => GetMessage("EXCH_SHOW_RATES_COMPONENT_DESCRIPTION"),
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "CURRENCY",
            "NAME" => GetMessage("EXCH_GROUP_NAME"),
        ),
    )
);
?>