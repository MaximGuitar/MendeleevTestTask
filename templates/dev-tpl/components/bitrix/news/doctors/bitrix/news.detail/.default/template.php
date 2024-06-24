<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<section class="doctor-page" x-data="SidebarTitles">
  <div class="container">
    <div class="left-col">
      <div class="top">
        <?php if ($arResult["DETAIL_PICTURE"]): ?>
          <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="" class="doctor-img">
        <?php endif ?>
        <div class="text-col">
          <h1 class="doctor-name h2 darkgreen-color"><?= $arResult["NAME"] ?></h1>
          <?php if ($arResult["SECTION"]["PATH"][0]["NAME"]): ?>
            <p class="text2"><?= $arResult["SECTION"]["PATH"][0]["NAME"] ?></p>
          <?php endif ?>
          <div class="doctor-props">
            <div class="doctor-prop darkgreen-color">
              <svg class="icon">
                <use href='<?= SPRITE_PATH ?>#work-experience'></use>
              </svg>
              <p class="text2">Стаж работы 13 лет</p>
            </div>
            <div class="doctor-prop darkgreen-color">
              <svg class="icon">
                <use href='<?= SPRITE_PATH ?>#calendar'></use>
              </svg>
              <p class="text2">Стоимость первичного приёма - от 1&nbsp;200&nbsp;₽</p>
            </div>
          </div>
          <p class="sign-up text2">Посмотрите <span class="darkgreen-color">ближайшую запись</span> и запишитесь на <span class="darkgreen-color">удобное время</span></p>
          <button class="sign-up-btn btn btn-lightgreen">Записаться онлайн</button>
        </div>
      </div>
      <div class="doctor-content" x-ref="content">
        <?$APPLICATION->IncludeComponent(
          "sprint.editor:blocks",
          "custom",
          [
            "ELEMENT_ID" => $arResult["ID"],
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "PROPERTY_CODE" => "CONTENT",
          ]
        );?>
      </div>
    </div>
    <div class="sidebar-col">
      <div class="sidebar" x-ref="sidebar">
        <template x-for="link in links">
          <a :href="`#${link.id}`" class="item text2" x-text="link.title"></a>
        </template>
      </div>
    </div>
  </div>
</section>