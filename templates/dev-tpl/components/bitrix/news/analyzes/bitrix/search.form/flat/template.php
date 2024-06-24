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
$this->setFrameMode(true);?>

<form
	hx-get="<?=$arResult["FORM_ACTION"]?>"
	hx-select=".analysis-card"
	hx-target="#items"
	hx-trigger="<?= isset($_REQUEST["q"]) ? "submit, load" : "submit" ?>"
	class="search-form"
>
	<input class="input font-inter text2" type="text" name="q" value="<?= $_REQUEST["q"] ?? "" ?>" size="15" maxlength="50" placeholder="Поиск"/>
	<button class="btn btn-lightgreen search-btn compact" name="s">
		<svg class="icon">
			<use href='<?= SPRITE_PATH ?>#search'></use>
		</svg>
	</button>
</form>