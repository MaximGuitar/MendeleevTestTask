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
		foreach ($arResult["ITEMS"] as $arItem):
			$section = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"])->GetNext();
	?>
		<div class="doctor-card">
			<?php if ($arItem["PREVIEW_PICTURE"]): ?>
				<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="" class="img">
			<?php endif ?>
			<div class="bottom">
				<p class="position text2"><?= $section["NAME"] ?></p>
				<p class="name text1">
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="link-cover"><?= $arItem["NAME"] ?></a>
				</p>
				<button class="btn btn-lightgreen has-icon">
					Подробнее о специалисте
					<svg class="arrow">
						<use href='<?= SPRITE_PATH ?>#arrow-to-right'></use>
					</svg>
				</button>
			</div>
		</div>
	<?php endforeach ?>
</div>
<?php if ($arResult["NAV_STRING"]): ?>
	<div id="pagination" <?= HX_BOOST ?> class="pagination-wrap">
		<?=$arResult["NAV_STRING"]?>
	</div>
<?php endif ?>