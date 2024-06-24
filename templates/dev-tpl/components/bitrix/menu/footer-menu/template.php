<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if(count($arResult) > 0): ?>
<?php foreach($arResult as $item): ?>
  <a href="<?= $item["LINK"] ?>" class="link text2"><?= $item["TEXT"] ?></a>
<?php endforeach ?>
<?php endif ?>