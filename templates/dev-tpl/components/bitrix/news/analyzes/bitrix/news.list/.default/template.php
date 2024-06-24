<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div id="items" class="items-grid">
	<?php
		foreach ($arResult["ITEMS"] as $arItem){
			$APPLICATION->IncludeComponent(
				"placestart:analyze.card",
				"",
				[
					"ID" => $arItem["ID"]
				]
			);
		}
	?>
</div>
<div id="pagination" hx-boost="true" class="pagination-wrap">
	<?=$arResult["NAV_STRING"]?>
</div>