<?
if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true )
	die();

global $USER;

use Bitrix\Main\Loader;
use Placestart\Utils;
use Placestart\WebpackAssets;
use Placestart\LocUtils;

Loader::includeModule( 'placestart.settings' );
$contacts = Placestart\Utils::getContacts();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<?php $assets = new WebpackAssets( SERVER_TPL_PATH . '/dist/manifest.json', SITE_TEMPLATE_PATH . '/' ); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400&family=Inter:wght@300;400;600;700&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="<?= $assets->get( 'main.css' ) ?>">
	<script src="<?= $assets->get( 'main.js' ) ?>" defer></script>

	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="canonical"
		href="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] ?><?= $APPLICATION->GetCurPage() ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url"
		content="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] ?><?= $APPLICATION->GetCurPage() ?>">
	<meta property="og:title" content="<? $APPLICATION->ShowTitle() ?>">
	<meta property="og:description" content="<? $APPLICATION->ShowProperty( "description" ) ?>">
	<meta property="og:image"
		content="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] ?><?= SITE_TEMPLATE_PATH ?>/static/images/404-image.png">
	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url"
		content="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] ?><?= $APPLICATION->GetCurPage() ?>">
	<meta property="twitter:title" content="<? $APPLICATION->ShowTitle() ?>">
	<meta property="twitter:description" content="<? $APPLICATION->ShowProperty( "description" ) ?>">
	<meta property="twitter:image"
		content="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] ?><?= SITE_TEMPLATE_PATH ?>/static/images/404-image.png">
	<script>
		window.sessid = "<?= bitrix_sessid() ?>"
		window.templatePath = "<?= SITE_TEMPLATE_PATH ?>"
		window.spritePath = "<?= SPRITE_PATH ?>"
	</script>
</head>

<body>
	<?php if ( $USER->IsAdmin() ) : ?>
		<div class="admin-panel">
			<? $APPLICATION->ShowPanel() ?>
		</div>
	<?php endif ?>
	<div id="app" class="app-wrap">
		<main id="main">