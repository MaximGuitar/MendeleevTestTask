<?php
  if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

  use Placestart\ComponentHelper;

  $helper = new Placestart\ComponentHelper($component);
?>

<section class="page-head">
  <div class="container">
    <?php
      $helper->deferredCall('Placestart\Utils::IncludeComponent', [
        'bitrix:breadcrumb',
        [],
        'breadcrumbs'
      ]);
    ?>
  </div>
</section>

<?php $helper->saveCache(); ?>