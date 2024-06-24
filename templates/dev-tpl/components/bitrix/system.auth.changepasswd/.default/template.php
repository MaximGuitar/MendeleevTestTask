<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
?>

<?
if (!empty($arParams["~AUTH_RESULT"]))
{
	ShowMessage($arParams["~AUTH_RESULT"]);
}
?>

<?if($arResult["SHOW_FORM"]):?>
<div class="auth-form default-form-colors">
	<p class="title h1 darkgreen-color">Смена пароля</p>
	<form class="form" method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
		<?if ($arResult["BACKURL"] <> ''): ?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<? endif ?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="CHANGE_PWD">
	
		<?if($arResult["USE_CAPTCHA"]):?>
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				</td>
			</tr>
			<tr>
				<td><span class="starrequired">*</span><?echo GetMessage("system_auth_captcha")?></td>
				<td><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" /></td>
			</tr>
		<?endif?>
	
		<?if($arResult["PHONE_REGISTRATION"]):?>
			<tr>
				<td><?echo GetMessage("sys_auth_chpass_phone_number")?></td>
				<td>
					<input type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" class="bx-auth-input" disabled="disabled" />
					<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
				</td>
			</tr>
			<tr>
				<td><span class="starrequired">*</span><?echo GetMessage("sys_auth_chpass_code")?></td>
				<td><input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input" autocomplete="off" /></td>
			</tr>
			<?else:?>
				<input class="form-input" type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="bx-auth-input" />
			<? if($arResult["USE_PASSWORD"]): ?>
				<tr>
					<td><span class="starrequired">*</span><?echo GetMessage("sys_auth_changr_pass_current_pass")?></td>
					<td><input type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="<?=$arResult["USER_CURRENT_PASSWORD"]?>" class="bx-auth-input" autocomplete="new-password" /></td>
				</tr>
			<? else: ?>
				<input type="hidden" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>"/>
			<? endif ?>
		<?endif?>
		<input class="form-input" type="password" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="new-password" />
		<input class="form-input" type="password" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="new-password" />

		<p class="text2"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>

		<input class="submit btn btn-lightgreen" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
	
		<div class="bottom">
			<a class="text2 lightgreen-color" href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
		</div>
	</form>
</div>

<?if($arResult["PHONE_REGISTRATION"]):?>

<script type="text/javascript">
new BX.PhoneAuth({
	containerId: 'bx_chpass_resend',
	errorContainerId: 'bx_chpass_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"]
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_chpass_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_chpass_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_chpass_resend"></div>

<?endif?>

<?endif?>