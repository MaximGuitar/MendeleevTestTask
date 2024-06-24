<?php /** @var $block array */ ?>
<div class="content-text-image <?= $block["imagePosition"] ?>-image content-block ">
	<img alt="<?= $image["DESCRIPTION"] ?>" class="img" src="<?= $block["image"]["file"]["ORIGIN_SRC"] ?>"
		loading="lazy">
	<div class="content-text"><?= $block["text"]["value"] ?></div>
</div>