<form
  hx-get="/local/ajax/"
  hx-indicator="find .submit-btn"
  hx-swap="outerHTML"
  class="grid"
>
  <?= tpl("dev/sessid") ?>
  <?= tpl("dev/action", ["action" => "footer_form"]) ?>
  <input
    x-data="PhoneInputMask"
    name="phone"
    type="tel"
    class="row-input <?= isset($errors["phone"]) ? 'error' : '' ?>"
    placeholder="Номер телефона"
  >
  <div>
    <?= tpl("components/submit-btn", ["text" => "Отправить", "loading_text" => "Отправляем"]) ?>
    <?php if ($status == "success"): ?>
      <div class="form-result success" x-init="setTimeout(() => $el.remove(), 10000)">
        <p class="form-result__text caption">Спасибо за заявку! Мы свяжемся с вами в ближайшее время</p>
        <p class="form-result__timer caption">10 сек</p>
      </div>
    <?php else: ?>
      <p class="personal caption">Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" target="_blank" class="personal__link">на обработку персональных данных</a></p>
    <?php endif ?>
  </div>
</form>