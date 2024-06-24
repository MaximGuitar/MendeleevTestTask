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
?>
<div class="category-select" x-data="{open: false}" @click="open = !open" @click.outside="open = false">
  <p class="h3"><?= $arResult["CURRENT_SECTION"]["NAME"] ?? "Все" ?></p>
  <svg class="arrow">
    <use href='<?= SPRITE_PATH ?>#arr-to-bottom'></use>
  </svg>
  <div class="dropdown-list" x-show="open">
    <a class="text2 <?= $arParams['CURRENT_SECTION'] == 'all' ? 'active' : '' ?>" href="<?= $arParams['NEWS_LINK'] ?>">Все</a>
    <?php foreach ($arResult['SECTIONS'] as $i => $arSection): ?>
      <a class="text2 <?= $arParams['CURRENT_SECTION'] == $arSection['CODE'] ? 'active' : '' ?>" href="<?= $arSection['SECTION_PAGE_URL'] ?>"><?= $arSection['NAME'] ?></a>
    <?php endforeach ?>
  </div>
</div>