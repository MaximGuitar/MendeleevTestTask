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

<div class="items-grid">
	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
		<div class="action-card" data-micromodal-trigger="modal-action-<?= $arItem["ID"] ?>">
			<h3 class="name h3 darkgreen-color"><?= $arItem["NAME"] ?></h3>
			<?php if ($arItem["PREVIEW_PICTURE"]): ?>
				<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="" class="bg">
			<?php endif ?>
			<?= tpl("navigation/next-arrow") ?>
		</div>
		<div class="modal modal-action" id="modal-action-<?= $arItem["ID"] ?>" data-micromodal-close aria-hidden="true">
			<div class="modal__overlay">
				<div class="modal__container">
					<div class="grid">
						<p class="subtitle h2 darkgreen-color"><?= $arItem["NAME"] ?></p>
						<div class="text-col">
							<?php if ($arItem["DETAIL_TEXT"]): ?>
								<div class="content-text">
									<?= $arItem["DETAIL_TEXT"] ?>
								</div>
							<?php endif ?>
						</div>
						<?php if ($arItem["DETAIL_PICTURE"]): ?>
							<div class="img-col">
								<img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="" class="img">
							</div>
						<?php endif ?>
					</div>
					<svg class="fancy-bg" width="1233" height="693" viewBox="0 0 1233 693" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M296.548 409.242L189.807 325.791L54.7158 312.887L138.494 206.543L151.449 72L258.21 155.451L393.281 168.355L309.502 274.679L296.548 409.242Z" fill="#D9F1DB"/>
						<path d="M723.162 560.563L842.829 466.639L994.278 452.116L900.355 332.427L885.832 181L766.143 274.924L614.716 289.446L708.639 409.113L723.162 560.563Z" fill="#DBDCDF"/>
						<path d="M469.525 685.733L407.815 637.298L329.716 629.809L378.15 568.088L385.639 490L447.361 538.434L525.449 545.924L477.014 607.633L469.525 685.733Z" fill="#DBDCDF"/>
						<path d="M285.206 319.738L203.147 302.42L124.059 331.799L142.564 250.314L113.88 172.372L195.95 189.684L275.027 160.311L256.517 241.785L285.206 319.738Z" fill="#DBDCDF"/>
						<path d="M745.357 451.551L830.251 426.481L915.266 451.177L890.202 366.271L914.893 281.268L829.987 306.332L744.984 281.641L770.053 366.535L745.357 451.551Z" fill="#D9F1DB"/>
						<path d="M448.523 408.657L508.565 361.532L584.554 354.245L537.428 294.192L530.142 218.215L470.088 265.34L394.111 272.627L441.237 332.669L448.523 408.657Z" fill="#D9F1DB"/>
						<path d="M935.209 218.223L952.304 204.806L973.939 202.731L960.522 185.632L958.447 164L941.349 177.418L919.716 179.492L933.134 196.588L935.209 218.223Z" fill="#D9F1DB"/>
						<path d="M903.848 648.034L929.282 628.071L961.472 624.984L941.509 599.545L938.422 567.36L912.983 587.323L880.798 590.41L900.761 615.844L903.848 648.034Z" fill="#D9F1DB"/>
						<path d="M72.7385 612.326L40.6328 587.127L0 583.231L25.199 551.119L29.0954 510.492L61.2072 535.691L101.834 539.588L76.6349 571.693L72.7385 612.326Z" fill="#D9F1DB"/>
						<path d="M1040.07 558.103L1056.74 545.012L1077.85 542.988L1064.76 526.307L1062.74 505.202L1046.06 518.293L1024.95 520.317L1038.04 536.995L1040.07 558.103Z" fill="#DBDCDF"/>
						<path d="M595.7 154.735L603.622 148.517L613.648 147.556L607.43 139.632L606.469 129.607L598.545 135.825L588.521 136.787L594.739 144.709L595.7 154.735Z" fill="#DBDCDF"/>
						<path d="M975.262 338.564L983.185 332.346L993.211 331.385L986.993 323.461L986.032 313.437L978.108 319.654L968.083 320.616L974.301 328.538L975.262 338.564Z" fill="#DBDCDF"/>
						<path d="M66.6931 470.817L74.6153 464.599L84.6416 463.638L78.4237 455.714L77.4622 445.689L69.5385 451.907L59.5138 452.869L65.7317 460.791L66.6931 470.817Z" fill="#DBDCDF"/>
						<path d="M983.198 693L991.12 686.782L1001.15 685.821L994.929 677.897L993.967 667.872L986.043 674.09L976.019 675.051L982.237 682.974L983.198 693Z" fill="#D9F1DB"/>
						<path d="M507.28 68.7704L499.358 62.5525L489.332 61.591L495.55 53.6674L496.511 43.6426L504.435 49.8605L514.46 50.822L508.242 58.7441L507.28 68.7704Z" fill="#D9F1DB"/>
						<path d="M1200.28 25.1278L1192.36 18.9099L1182.33 17.9485L1188.55 10.0248L1189.51 0L1197.44 6.21794L1207.46 7.17938L1201.24 15.1016L1200.28 25.1278Z" fill="#D9F1DB"/>
						<path d="M102.664 69.1278L94.7421 62.9099L84.7158 61.9485L90.9338 54.0248L91.8952 44L99.8189 50.2179L109.844 51.1794L103.626 59.1016L102.664 69.1278Z" fill="#D9F1DB"/>
						<path d="M1194.8 100.511L1211.48 87.4207L1232.59 85.3966L1219.5 68.7152L1217.47 47.6104L1200.79 60.7008L1179.69 62.7248L1192.78 79.4031L1194.8 100.511Z" fill="#DBDCDF"/>
						<path d="M56.3019 181.185L39.6236 168.095L18.5156 166.07L31.606 149.389L33.6301 128.284L50.3116 141.375L71.4164 143.399L58.326 160.077L56.3019 181.185Z" fill="#DBDCDF"/>
					</svg>
					<button class="modal__close" data-micromodal-close="">
						<svg class="icon">
							<use href="/local/templates/gk-imt/static/images/sprite.svg#close"></use>
						</svg>
					</button>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<div class="pagination-wrap">
	<?=$arResult["NAV_STRING"]?>
</div>