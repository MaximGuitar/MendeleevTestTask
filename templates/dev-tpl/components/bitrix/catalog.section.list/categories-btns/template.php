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

use Placestart\LocUtils;
$loc = new LocUtils(__FILE__, false);

?>

<div class="categories-btns" hx-boost="true" hx-select="#main" hx-target="#main" hx-swap="outerHTML">
  <a class="btn <?= $arParams['CURRENT_SECTION'] == 'all' ? 'btn-red' : 'btn-red-border' ?>" href="<?= $arParams['NEWS_LINK'] ?>"><?= $loc->getMessage("SHOW_ALL") ?></a>
	<?php foreach ($arResult['SECTIONS'] as $i => $arSection): ?>
    <a class="btn <?= $arParams['CURRENT_SECTION'] == $arSection['CODE'] ? 'btn-red' : 'btn-red-border' ?>" href="<?= $arSection['SECTION_PAGE_URL'] ?>"><?= $arSection['NAME'] ?></a>
	<?php endforeach ?>
</div>