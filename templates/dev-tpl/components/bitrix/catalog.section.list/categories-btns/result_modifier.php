<?php
  foreach($arResult['SECTIONS'] as $arSection){
    if ($arSection['CODE'] == $arParams['CURRENT_SECTION']){
      $arResult['CURRENT_SECTION'] = $arSection;
      break;
    }
  }
?>