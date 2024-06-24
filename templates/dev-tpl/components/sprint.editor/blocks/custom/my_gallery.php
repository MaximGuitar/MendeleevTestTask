<?php
/**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */

$images = Sprint\Editor\Blocks\Gallery::getImages(
	$block, [ 
		'width' => 810,
		'height' => 500,
		'exact' => 0,
	]
);
?>

<?php if ( ! empty( $images ) ) : ?>
	<div class="content-gallery cols-<?= $block['perRow'] ?> content-block" x-data="FancyboxGallery">
		<?php foreach ( $images as $image ) : ?>
			<div class="content-gallery-item">
				<a data-fancybox='gallery' href="<?= $image['ORIGIN_SRC'] ?>" class="content-gallery-item__wrap">
					<img alt="<?= $image['DESCRIPTION'] ?>" src="<?= $image['SRC'] ?>" class="content-gallery-item__img">
					<span class="content-gallery-item__overlay">
						<svg class="content-gallery-item__zoom">
							<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#zoom'></use>
						</svg>
					</span>
				</a>
				<?php if ( $image['DESCRIPTION'] ) : ?>
					<p class="content-gallery-item__caption"><?= $image['DESCRIPTION'] ?></p>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>