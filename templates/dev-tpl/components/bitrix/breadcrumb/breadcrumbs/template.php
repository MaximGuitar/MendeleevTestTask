<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";
ob_start();
?>
<nav id="breadcrumbs" class="breadcrumbs font-inter darkgreen-color" itemscope itemtype="http://schema.org/BreadcrumbList">
	<ul>
		<li itemscope itemprop="itemListElement" class="caption">
			<span itemprop="name">
				<a href="/">
					Главная
				</a>
			</span>
		</li>
		<? foreach ($arResult as $i => $arItem): ?>
			<li itemscope itemprop="itemListElement" class="caption">
				<span itemprop="name">
					-
					<a href="<?= $arItem['LINK'] ?>">
						<?= $arItem['TITLE'] ?>
					</a>
				</span>
			</li>
		<? endforeach ?>
	</ul>
</nav>
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
?>