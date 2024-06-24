<?php if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true )
	die(); ?>
<?php
ShowMessage( $arParams["~AUTH_RESULT"] );
$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
	array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "N",
		"SHOW_FIELDS" => array( "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_BIRTHDAY", "PERSONAL_PHONE" ),
		"REQUIRED_FIELDS" => array( "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_BIRTHDAY", "PERSONAL_PHONE" ),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => $APPLICATION->GetCurPageParam( "success=Y", [] ),
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array()
	)
);
?>