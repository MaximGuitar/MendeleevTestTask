<?php
if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true )
	die();
use \Bitrix\Main\Loader;

Loader::includeModule( "placestart.settings" );
use Placestart\ComponentUtils;

$arComponentDescription = ComponentUtils::getComponentDescription( "Политика конфиденциальности", "privacy.policy", "pages" );
?>