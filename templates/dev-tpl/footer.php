<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();

use Placestart\Utils;
use Placestart\LocUtils;

$contacts = Placestart\Utils::getContacts();
?>
</main>

</div>

<div id="modal-notify" class="modal small-modal" x-data="ModalHelper" @show-notify.window="open('self')">
    <div class="modal__overlay" @click.self="close('self')">
        <div class="modal__container default-form-colors">
            <button class="modal__close" @click="close('self')">
                <svg class="icon">
                    <use href="<?= SPRITE_PATH ?>#cross"></use>
                </svg>
            </button>

            <div class="message-container" id="modal-notify-message" hx-swap-oob="true"></div>
        </div>
    </div>
</div>

</body>
</html>