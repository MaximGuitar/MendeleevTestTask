<?php
  if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

  use Placestart\LocUtils;
  $loc = new LocUtils(__FILE__, false);

  $MESS = $loc->createLoc([
    'SHOW_ALL' => 'All'
  ]);
?>