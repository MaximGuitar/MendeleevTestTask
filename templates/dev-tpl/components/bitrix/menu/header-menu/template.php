<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if(count($arResult) > 0): ?>

<nav class="menu">
  <?php foreach($arResult as $item): ?>
    <?php if ($item["IS_PARENT"]): ?>
      <div
        class="item parent"
        x-data="{open: false}"
        :class="open && 'open'"
        @click.outside="open = false"
        @keyup.escape="open = false"
      >
        <a href="<?= $item["LINK"] ?>" class="link caption" @click.prevent="open = !open">
          <svg class="icon menu-open">
            <use href='<?= SPRITE_PATH ?>#menu-open'></use>
          </svg>
          <svg class="icon menu-close">
            <use href='<?= SPRITE_PATH ?>#menu-close'></use>
          </svg>
          <?= $item["TEXT"] ?>
        </a>
        <div class="submenu" >
          <?php foreach($item["CHILD"] as $subitem): ?>
            <a href="<?= $subitem["LINK"] ?>" class="link caption"><?= $subitem["TEXT"] ?></a>
          <?php endforeach ?>
        </div>
      </div>
    <?php else: ?>
      <a href="<?= $item["LINK"] ?>" class="item link caption"><?= $item["TEXT"] ?></a>
    <?php endif ?>
  <?php endforeach ?>
</nav>
<?php endif ?>