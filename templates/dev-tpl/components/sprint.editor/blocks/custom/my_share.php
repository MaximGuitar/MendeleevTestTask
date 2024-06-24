<?php
  $title = trim($block['title']);
  $link = urlencode( trim($block['link']) );
?>
<div class="content-block content-share">
  <h2 class="h2 title">Поделитесь темой</h2>
  <div class="links">
    <a
      href="https://vk.com/share.php?url=<?= $link ?>&title=<?= $title ?>"
      class="contact-link"
      target="_blank"
    >
      <?php tpl('icons/vk', ['class' => 'contact-link-icon']) ?>
    </a>
    <a
      href="https://twitter.com/intent/tweet?text=<?= $title ?>&url=<?= $link ?>"
      class="contact-link"
      target="_blank"
    >
      <?php tpl('icons/twitter', ['class' => 'contact-link-icon']) ?>
    </a>
    <a
      href="https://connect.ok.ru/offer?url=<?= $link ?>&title=<?= $title ?>"
      class="contact-link"
      target="_blank"
    >
      <?php tpl('icons/odnoklassniki', ['class' => 'contact-link-icon']) ?>
    </a>
    <a
      href="https://api.whatsapp.com/send?text=<?= $title ?> <?= $link ?>"
      class="contact-link"
      target="_blank"
    >
      <?php tpl('icons/whatsapp', ['class' => 'contact-link-icon']) ?>
    </a>
    <a
      href="https://t.me/share/url?url=<?= $link ?>&text=<?= urlencode($title) ?>"
      class="contact-link"
      target="_blank"
    >
      <?php tpl('icons/tlg', ['class' => 'contact-link-icon']) ?>
    </a>
  </div>
</div>