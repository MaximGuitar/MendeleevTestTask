<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true )
	die();

if ( $arResult["SHOW_SMS_FIELD"] == true ) {
	CJSCore::Init( 'phone_auth' );
}
?>
<div class="auth-form default-form-colors">
	<p class="title h1 darkgreen-color">Регистрация</p>

	<?php if ( isset( $_REQUEST["success"] ) && $_REQUEST["success"] == "Y" ) : ?>
		<p><?= GetMessage( "REGISTER_EMAIL_SUCCESS" ) ?></p>
	<?php else : ?>
		<? if ( $USER->IsAuthorized() ) : ?>
			<p><?= GetMessage( "MAIN_REGISTER_AUTH" ) ?></p>
		<? else : ?>
			<?
			if ( ! empty( $arResult["ERRORS"] ) ) :
				foreach ( $arResult["ERRORS"] as $key => $error )
					if ( intval( $key ) == 0 && $key !== 0 )
						$arResult["ERRORS"][ $key ] = str_replace( "#FIELD_NAME#", "&quot;" . GetMessage( "REGISTER_FIELD_" . $key ) . "&quot;", $error );

				ShowError( implode( "<br />", $arResult["ERRORS"] ) );
			elseif ( $arResult["USE_EMAIL_CONFIRMATION"] === "Y" ) :
				?>
				<p><?= GetMessage( "REGISTER_EMAIL_WILL_BE_SENT" ) ?></p>
			<?php endif ?>

			<? if ( $arResult["SHOW_SMS_FIELD"] == true ) : ?>

				<form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
					<?
					if ( $arResult["BACKURL"] <> '' ) :
						?>
						<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
						<?
					endif;
					?>
					<input type="hidden" name="SIGNED_DATA" value="<?= htmlspecialcharsbx( $arResult["SIGNED_DATA"] ) ?>" />
					<table>
						<tbody>
							<tr>
								<td>
									<? echo GetMessage( "main_register_sms" ) ?><span class="starrequired">*</span>
								</td>
								<td><input size="30" type="text" name="SMS_CODE"
										value="<?= htmlspecialcharsbx( $arResult["SMS_CODE"] ) ?>" autocomplete="off" /></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td><input type="submit" name="code_submit_button"
										value="<? echo GetMessage( "main_register_sms_send" ) ?>" /></td>
							</tr>
						</tfoot>
					</table>
				</form>

				<script>
					new BX.PhoneAuth({
						containerId: 'bx_register_resend',
						errorContainerId: 'bx_register_error',
						interval: <?= $arResult["PHONE_CODE_RESEND_INTERVAL"] ?>,
						data:
							<?= CUtil::PhpToJSObject( [ 
								'signedData' => $arResult["SIGNED_DATA"],
							] ) ?>,
						onError:
							function (response) {
								var errorDiv = BX('bx_register_error');
								var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
								errorNode.innerHTML = '';
								for (var i = 0; i < response.errors.length; i++) {
									errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
								}
								errorDiv.style.display = '';
							}
					});
				</script>

				<div id="bx_register_error" style="display:none">
					<? ShowError( "error" ) ?>
				</div>

				<div id="bx_register_resend"></div>

			<? else : ?>

				<form class="register-form" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform"
					enctype="multipart/form-data">
					<? if ( $arResult["BACKURL"] <> '' ) : ?>
						<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
					<? endif; ?>

					<div class="fields">
						<input class="form-input" placeholder="Логин" type="text" name="REGISTER[LOGIN]" value="">
						<input class="form-input" placeholder="Телефон" type="text" name="REGISTER[PERSONAL_PHONE]" value="">
						<input class="form-input" placeholder="Эл. почта" type="text" name="REGISTER[EMAIL]" value="">
						<input class="form-input" placeholder="Имя" type="text" name="REGISTER[NAME]" value="">
						<input class="form-input" placeholder="Фамилия" type="text" name="REGISTER[LAST_NAME]" value="">
						<input class="form-input" placeholder="Отчество" type="text" name="REGISTER[SECOND_NAME]" value="">
						<select class="form-input" name="REGISTER[PERSONAL_GENDER]">
							<option value="">Пол</option>
							<option value="M">Мужской</option>
							<option value="F">Женский</option>
						</select>
						<input class="form-input" type="text" placeholder="Дата рождения" name="REGISTER[PERSONAL_BIRTHDAY]"
							value="">
						<input class="form-input" placeholder="Пароль" type="password" name="REGISTER[PASSWORD]" value=""
							autocomplete="off">
						<input class="form-input" placeholder="Подтверждение пароля" type="password"
							name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
					</div>

					<?
					if ( $arResult["USE_CAPTCHA"] == "Y" ) {
						?>
						<tr>
							<td colspan="2"><b><?= GetMessage( "REGISTER_CAPTCHA_TITLE" ) ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180"
									height="40" alt="CAPTCHA" />
							</td>
						</tr>
						<tr>
							<td><?= GetMessage( "REGISTER_CAPTCHA_PROMT" ) ?>:<span class="starrequired">*</span></td>
							<td><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" /></td>
						</tr>
						<?
					}
					?>

					<p class="text2"><?= $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"] ?></p>

					<div class="buttons-row">
						<input class="submit btn btn-lightgreen" type="submit" name="register_submit_button"
							value="Зарегистрироваться" />
					</div>
				</form>

			<? endif ?>
		<? endif ?>
	<? endif ?>
</div>