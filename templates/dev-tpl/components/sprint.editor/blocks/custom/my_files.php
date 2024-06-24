<?php /**
  * @var $block array
  * @var $this  SprintEditorBlocksComponent
  */

use Placestart\Utils;

?>
<?php if ( ! empty( $block['files'] ) ) : ?>
	<div class="content-files content-block">
		<?php
		foreach ( $block['files'] as $item ) :
			$info = Utils::getFileInfo( $item['file']['CONTENT_TYPE'], $item['file']['FILE_SIZE'] );
			?>
			<div class="content-file-row">
				<svg class="icon" width="28" height="37" viewBox="0 0 28 37" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M0 1C0 0.447715 0.447715 0 1 0H16C16.2729 0 16.534 0.111551 16.7226 0.308777L27.7226 11.8088C27.9007 11.9949 28 12.2425 28 12.5V35.5C28 36.0523 27.5523 36.5 27 36.5H1C0.447715 36.5 0 36.0523 0 35.5V1ZM2 2V34.5H26V13.5H16C15.4477 13.5 15 13.0523 15 12.5V2H2ZM17 3.49217L24.6597 11.5H17V3.49217ZM14 17.5C14.4767 17.5 14.8871 17.8365 14.9806 18.3039C15.4396 20.5989 17.33 24.3899 20.1402 26.7318C20.5415 27.0662 20.6178 27.6532 20.3153 28.0791C20.0128 28.505 19.4334 28.6263 18.9855 28.3575C17.9615 27.7431 16.1741 27.375 14.1875 27.375C12.2174 27.375 10.2614 27.7374 8.94721 28.3944C8.48037 28.6278 7.91252 28.463 7.64329 28.0158C7.37407 27.5687 7.49403 26.9896 7.91876 26.6863C11.1282 24.3938 12.5445 20.6785 13.0194 18.3039C13.1129 17.8365 13.5233 17.5 14 17.5ZM11.9456 25.5153C12.6891 25.4208 13.4465 25.375 14.1875 25.375C14.881 25.375 15.5823 25.4152 16.2638 25.4997C15.3561 24.2888 14.612 22.9952 14.0551 21.7671C13.5605 22.9921 12.8757 24.2932 11.9456 25.5153Z" />
				</svg>
				<p class="meta">
					<?= $info['mime'] ?>
					<?= $info['size'] ?>
				</p>
				<a href="<?= $item['file']['SRC'] ?>" download="<?= $item['file']['ORIGINAL_NAME'] ?>" class="name link-cover">
					<?= $item['desc'] ? $item['desc'] : $item['file']['ORIGINAL_NAME'] ?>
				</a>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>