<?php
  global $USER;

  define('SERVER_TPL_PATH', $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH);
  define('PLATES_PATH', SERVER_TPL_PATH . "/plates/");
  define('SPRITE_PATH', SITE_TEMPLATE_PATH."/static/images/sprite.svg");
  define('HX_BOOST', 'hx-boost="'.($USER->IsAdmin() ? 'false' : 'true').'"');
?>