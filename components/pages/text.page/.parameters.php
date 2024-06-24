<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

  use \Bitrix\Main\Loader;
  Loader::includeModule("placestart.settings");
  use Placestart\ComponentParameters;

  $params = new ComponentParameters();

  $params->group("DATA", "Параметры", 100, [
    "IBLOCK" => $params->iblock("Инфоблок"),
    "CONTENT_PROPERTY_CODE" => $params->string("Код свойства с контентом", ["DEFAULT" => "CONTENT"]),
    "ELEMENT" => $params->string("ID элемента")
  ]);

  $arComponentParameters = $params->create();
?>