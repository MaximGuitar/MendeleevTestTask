<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

if (!empty($arParams["~AUTH_RESULT"]))
{
	ShowMessage($arParams["~AUTH_RESULT"]);
}

?>
<div class="auth-form default-form-colors">
	<p class="title h1 darkgreen-color">Сброс пароля</p>
	<form class="form" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		<? if ($arResult["BACKURL"] <> ''):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">
	
		<input class="form-input" type="text" placeholder="<?=GetMessage("sys_forgot_pass_login1")?>" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" />
		<input type="hidden" name="USER_EMAIL" />
		<p class="caption"><?echo GetMessage("sys_forgot_pass_note_email")?></p>
	
		<?if($arResult["PHONE_REGISTRATION"]):?>
			<div style="margin-top: 16px">
				<div><b><?=GetMessage("sys_forgot_pass_phone")?></b></div>
				<div><input type="text" name="USER_PHONE_NUMBER" value="<?=$arResult["USER_PHONE_NUMBER"]?>" /></div>
				<div><?echo GetMessage("sys_forgot_pass_note_phone")?></div>
			</div>
		<?endif;?>
	
		<?if($arResult["USE_CAPTCHA"]):?>
			<div style="margin-top: 16px">
				<div>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				</div>
				<div><?echo GetMessage("system_auth_captcha")?></div>
				<div><input type="text" name="captcha_word" maxlength="50" value="" /></div>
			</div>
		<?endif?>
		<input class="submit btn btn-lightgreen" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
		<div class="bottom lightgreen-color"">
			<a class="text2" href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
		</div>
	</form>
</div>


<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
