<?php /** @var $block array */?>

<div class="content-block content-video-text">
  <div class="content-wrap">
    <?php if ($block['video']): ?>
      <div class="video-wrap">
        <?= Sprint\Editor\Blocks\Video::getHtml($block['video']) ?>
      </div>
    <?php endif ?>
    <?php if ($block['text']): ?>
      <div class="content-text"><?= $block['text']['value'] ?></div>
    <?php endif ?>
  </div>
</div>