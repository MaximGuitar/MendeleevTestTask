<button
  data-text="<?= $text ?>"
  data-loading-text="<?= $loading_text ?>"
  class="submit-btn btn btn-lightgreen has-icon"
>
  <?= tpl("components/preloader") ?>
  <svg class="arrow">
    <use href='<?= SPRITE_PATH ?>#arrow-to-right'></use>
  </svg>
</button>