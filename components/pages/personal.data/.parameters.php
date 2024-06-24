<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();
use \Bitrix\Main\Loader;
Loader::includeModule('placestart.settings');
use Placestart\ComponentParameters;

$params = new ComponentParameters();
$params->group("DATA", "Параметры", 100, [
  "COMPANY" =>  $params->string("Название компании"),
  "ADDRESS" =>  $params->string("Юридический адрес"),
]);
$arComponentParameters = $params->create();
?>