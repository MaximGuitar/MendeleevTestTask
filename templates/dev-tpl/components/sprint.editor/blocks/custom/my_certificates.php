<?php
/**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */

$images = Sprint\Editor\Blocks\Gallery::getImages(
    $block, [
        'width'  => 810,
        'height' => 500,
        'exact'  => 0,
    ]
);
?>

<?php if (!empty($images)): ?>
    <div class="content-gallery content-certificates content-block cols-4">
        <?php foreach ($images as $image): ?>
            <div class="gallery-item">
                <a data-fancybox='gallery' href="<?= $image['ORIGIN_SRC'] ?>" class="gallery-item__wrap">
                    <img alt="<?= $image['DESCRIPTION'] ?>" src="<?= $image['SRC'] ?>" class="gallery-item__img certificate">
                </a>
                <?php if ($image['DESCRIPTION']): ?>
                    <p class="gallery-item__caption"><?= $image['DESCRIPTION'] ?></p>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>