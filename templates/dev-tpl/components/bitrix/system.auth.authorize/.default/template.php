<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="auth-form default-form-colors">
	<p class="title h1 darkgreen-color">Вход в личный кабинет</p>

	<?
	if (!empty($arParams["~AUTH_RESULT"]))
	{
		ShowMessage($arParams["~AUTH_RESULT"]);
	}

	if (!empty($arResult['ERROR_MESSAGE']))
	{
		ShowMessage($arResult['ERROR_MESSAGE']);
	}
	?>

	<?if($arResult["AUTH_SERVICES"]):?>
		<div class="bx-auth-title"><?= GetMessage("AUTH_TITLE")?></div>
	<?endif?>

	<form class="form" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if ($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

		<?if($arResult["CAPTCHA_CODE"]):?>
			<tr>
				<td></td>
				<td><input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label"><?= GetMessage("AUTH_CAPTCHA_PROMT")?>:</td>
				<td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" /></td>
			</tr>
		<?endif;?>
		
		<input class="form-input" type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
		<input class="form-input" type="password" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
		<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
			<div class="store-password">
				<input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
				<label class="text2" for="USER_REMEMBER"><?=GetMessage("AUTH_REMEMBER_ME")?></label>
			</div>
		<?endif?>

		<input type="submit" class="submit btn btn-lightgreen" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />

		<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
			<div class="bottom lightgreen-color">
				<?if($arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
					<a class="text2" href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
				<?endif?>
				<a class="text2" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</div>
		<?endif?>
	</form>
</div>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
