<?php
  use Bitrix\Main\Localization\Loc;
  use Bitrix\Main\HttpApplication;
  use Bitrix\Main\Loader;
  use Bitrix\Main\Config\Option;

  Loc::loadMessages(__FILE__);

  $request = HttpApplication::getInstance()->getContext()->getRequest();
  $module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);
  Loader::includeModule($module_id);

  function generateSiteOpitons($site_id){
    return [
      'Контакты',
      [
        'tel'."_$site_id",
        'Телефон',
        "",
        ['text', 20]
      ],
      [
        'address'."_$site_id",
        'Адрес',
        "",
        ['text', 20]
      ],
      [
        'coordinates'."_$site_id",
        'Координаты на карте',
        "",
        ['text', 20]
      ],
      [
        'email'."_$site_id",
        'Эл. почта',
        "",
        ['text', 20]
      ],
    ];
  }

  $arSites = [];
  $arTabs = [];
	$db_res = CSite::GetList('id', 'asc', ['ACTIVE' => 'y']);
	while($res = $db_res->Fetch()){
		$arSites[] = $res;
	}

  foreach($arSites as $arSite){
    $arTabs[] = [
      'DIV' => 'edit_' . $arSite['LID'],
      'TAB' => $arSite['NAME'],
      'TITLE' => $arSite['NAME'],
      'OPTIONS' => generateSiteOpitons($arSite['LID'])
    ];
  }

  if($request->isPost() && check_bitrix_sessid()){
    foreach($arTabs as $aTab){
      foreach($aTab["OPTIONS"] as $arOption){
        if(!is_array($arOption)){
          continue;
        }

        if($arOption["note"]){
          continue;
        }

        if($request["apply"]){
          $optionValue = $request->getPost($arOption[0]);
          Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
        }
        elseif($request["default"]){
          Option::set($module_id, $arOption[0], $arOption[2]);
        }
      }
    }

    LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
  }

  $tabControl = new CAdminTabControl(
    "tabControl",
    $arTabs
  );
  
  $tabControl->Begin();
?>
<form action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= $module_id ?>&lang=<?= LANG ?>" method="post">
  <?
    foreach($arTabs as $aTab){
        if($aTab["OPTIONS"]){
          $tabControl->BeginNextTab();
          __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
        }
    }
    $tabControl->Buttons();
  ?>
  <input type="submit" name="apply" value="Применить" class="adm-btn-save" />
  <?= bitrix_sessid_post() ?>
</form>
<?php $tabControl->End() ?>