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

<?php foreach ($arResult["ITEMS"] as $arItem): ?>
	<div class="review-card">
		<div class="rating-row">
			<?= tpl("components/rating-stars", ["score" => $arItem["DISPLAY_PROPERTIES"]["SCORE"]["VALUE"]]) ?>
			<p class="date caption"><?= $arItem["ACTIVE_FROM"] ?></p>
		</div>
		<p class="name text1 darkgreen-color"><?= $arItem["NAME"] ?></p>
		<?php if ($arItem["DISPLAY_PROPERTIES"]["REVIEW_TEXT"]["DISPLAY_VALUE"]): ?>
			<div class="review-text content-text"><?= $arItem["DISPLAY_PROPERTIES"]["REVIEW_TEXT"]["DISPLAY_VALUE"] ?></div>
		<?php endif ?>
		<?php if ($arItem["DISPLAY_PROPERTIES"]["ANSWER_TEXT"]["DISPLAY_VALUE"]): ?>
			<div class="bottom" x-data="Accordion">
				<div class="toggle-row">
					<p class="text1 darkgreen-color">Ответ компании</p>
					<button class="answer-toggle text2 lightgreen-color" @click="open = !open" x-text="open ? 'Скрыть' : 'Показать'"></button>
				</div>
				<div class="collapse is-collapsed" x-ref="collapse">
					<div class="answer-text content-text"><?= $arItem["DISPLAY_PROPERTIES"]["ANSWER_TEXT"]["DISPLAY_VALUE"] ?></div>
				</div>
			</div>
		<?php endif ?>
	</div>
<?php endforeach ?>
<?php if ($arResult["NAV_STRING"]): ?>
<div class="pagination-wrap">
	<?=$arResult["NAV_STRING"]?>
</div>
<?php endif ?>