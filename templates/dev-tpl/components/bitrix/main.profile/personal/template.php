<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Placestart\ComponentHelper;

$helper = new ComponentHelper($component);
?>

<section class="personal-account">
	<div class="head">
		<?php
			$helper->deferredCall('Placestart\Utils::IncludeComponent', [
				'placestart:page.head',
				[],
				''
			]);
		?>
		<?= tpl("components/personal-tabs", ["current" => "personal"]) ?>
	</div>
	
	<div class="body">
		<div class="container">
			<?
			ShowError($arResult["strProfileError"]);
			if ($arResult['DATA_SAVED'] == 'Y')
				ShowNote(GetMessage('PROFILE_DATA_SAVED'));
			?>
		</div>
		<div class="personal-data container">
			<?
				if($arResult["SHOW_SMS_FIELD"] == true):
					CJSCore::Init('phone_auth');
			?>
				<form method="post" action="<?=$arResult["FORM_TARGET"]?>">
					<?=$arResult["BX_SESSION_CHECK"]?>
					<input type="hidden" name="lang" value="<?=LANG?>" />
					<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
					<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
					<table class="profile-table data-table">
						<tbody>
							<tr>
								<td><?echo GetMessage("main_profile_code")?><span class="starrequired">*</span></td>
								<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
							</tr>
						</tbody>
					</table>
			
					<p><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_profile_send")?>" /></p>
				</form>
			
				<script>
					new BX.PhoneAuth({
						containerId: 'bx_profile_resend',
						errorContainerId: 'bx_profile_error',
						interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
						data:
							<?=CUtil::PhpToJSObject([
								'signedData' => $arResult["SIGNED_DATA"],
							])?>,
						onError:
							function(response)
							{
								var errorDiv = BX('bx_profile_error');
								var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
								errorNode.innerHTML = '';
								for(var i = 0; i <script response.errors.length; i++)
								{
									errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
								}
								errorDiv.style.display = '';
							}
					});
				</script>
			
				<div id="bx_profile_error" style="display:none"><?ShowError("error")?></div>
				<div id="bx_profile_resend"></div>
			
			<?else:?>
				<form
					class="form default-form-colors"
					method="post"
					name="form1"
					action="<?=$arResult["FORM_TARGET"]?>"
					enctype="multipart/form-data"
				>
					<div class="fields">
						<?=$arResult["BX_SESSION_CHECK"]?>
						<input type="hidden" name="lang" value="<?=LANG?>" />
						<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
					
						<div class="name-row">
							<div class="form-input-wrap">
								<p class="form-placeholder">Имя</p>
								<input type="text" class="form-input" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>">
							</div>
							<div class="form-input-wrap">
								<p class="form-placeholder">Фамилия</p>
								<input type="text" class="form-input" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
							</div>
							<div class="form-input-wrap">
								<p class="form-placeholder">Отчество</p>
								<input type="text" class="form-input" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>">
							</div>
						</div>
						<div class="info-row">
							<div class="form-input-wrap">
								<p class="form-placeholder">Дата рождения</p>
								<input type="text" class="form-input" name="PERSONAL_BIRTHDAY" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>">
							</div>
							<div class="form-input-wrap">
								<p class="form-placeholder">Пол</p>
								<select class="form-input" name="PERSONAL_GENDER">
									<option <?= $arResult["arUser"]["PERSONAL_GENDER"] == "M" ? "selected" : "" ?> value="M">Мужской</option>
									<option <?= $arResult["arUser"]["PERSONAL_GENDER"] == "F" ? "selected" : "" ?> value="F">Женский</option>
								</select>
							</div>
							<div class="form-input-wrap">
								<p class="form-placeholder">Email</p>
								<input type="text" class="form-input" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>">
							</div>
							<div class="form-input-wrap">
								<p class="form-placeholder">Телефон</p>
								<input type="text" class="form-input" x-data="PhoneInputMask" name="PERSONAL_PHONE" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
							</div>
						</div>
						<div class="password-row">
							<div class="form-input-wrap ">
								<p class="form-placeholder">Изменить пароль</p>
								<div class="password-input" x-data="{show: false}">
									<input :type="show ? 'text' : 'password'" class="form-input" name="NEW_PASSWORD" value="<?=$arResult["arUser"]["NEW_PASSWORD"]?>" placeholder="Введите новый пароль">
									<button class="eye" type="button" @click="show = !show">
										<svg class="eye-icon">
											<use href='<?= SPRITE_PATH ?>#eye'></use>
										</svg>
									</button>
								</div>
							</div>
							<div class="form-input-wrap">
								<div class="password-input" x-data="{show: false}">
									<input :type="show ? 'text' : 'password'" class="form-input" name="NEW_PASSWORD_CONFIRM" value="<?=$arResult["arUser"]["NEW_PASSWORD_CONFIRM"]?>" placeholder="Повторите пароль">
									<button class="eye" type="button" @click="show = !show">
										<svg class="eye-icon">
											<use href='<?= SPRITE_PATH ?>#eye'></use>
										</svg>
									</button>
								</div>
							</div>
						</div>
					</div>
					<button name="save" value="Изменить данные" class="save-btn font-inter">
						<svg class="icon">
							<use href='<?= SPRITE_PATH ?>#edit'></use>
						</svg>
						<span>Изменить данные</span>
					</button>
				</form>
			<?endif?>
			<?$APPLICATION->IncludeComponent(
				"placestart:recomend.analyzes",
				"sidebar",
				Array(
					"COUNT" => "2"
				)
			);?>
		</div>
	</div>
</section>

<?php $helper->saveCache(); ?>