<?php
  use Bitrix\Main\Localization\Loc;
  use Bitrix\Main\ModuleManager;
  use Bitrix\Main\Config\Option;
  use Bitrix\Main\EventManager;
  use Bitrix\Main\Application;
  use Bitrix\Main\IO\Directory;

  Loc::loadMessages(__FILE__);

  Class placestart_settings extends CModule{
    var $MODULE_ID = "placestart.settings";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function __construct(){
      $arModuleVersion = [];

      include_once(__DIR__."/version.php");

      $this->MODULE_VERSION = $arModuleVersion["VERSION"];
      $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
      $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
      $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
      $this->PARTNER_NAME = Loc::getMessage('PARTNER_NAME');
      $this->PARTNER_URI = Loc::getMessage('PARTNER_URI');
    }

    public function InstallFiles(){
      return false;
    }

    public function InstallDB(){
      return false;
    }

    public function InstallEvents(){
      return false;
    }

    public function DoInstall(){
      global $APPLICATION;

      $this->InstallFiles();
      $this->InstallDB();

      ModuleManager::registerModule($this->MODULE_ID);

      $this->InstallEvents();

      $APPLICATION->IncludeAdminFile(Loc::getMessage('MODULE_INSTALLED'), __DIR__."/step.php");
    }

    public function DoUninstall(){
      global $APPLICATION;
      
      ModuleManager::unRegisterModule($this->MODULE_ID);

      $APPLICATION->IncludeAdminFile(Loc::getMessage('MODULE_UNINSTALLED'), __DIR__."/unstep.php");
    }
  }
?>