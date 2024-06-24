<?php
namespace Placestart;

use \Bitrix\Main\Loader;

class ComponentBoilerplate extends \CBitrixComponent{
  protected $cacheKeys = [];
  protected $cacheTime = 3600000;

  protected function getData(){
    $this->arResult = [];
  }

  /**
   * Подключает модуль инфоблоков
   * @return boolean
  */
  protected function loadIblock(){
    if (!Loader::includeModule('iblock')) {
      throw new \Exception('Не загружены модули необходимые для работы модуля');
    }
    return true;
  }

  /**
   * Выполнение компонента, подключение шаблона
   * @return void
   */
  public function executeComponent()
  {
    if ( isset($this->arParams["RESET_CACHE"]) && $this->arParams["RESET_CACHE"] == "Y" )
      $this->ClearResultCache();

    if ($this->StartResultCache($this->cacheTime)) {
      $this->getData();
      $this->setResultCacheKeys($this->cacheKeys);
      $this->includeComponentTemplate();
    }
  }
}
?>