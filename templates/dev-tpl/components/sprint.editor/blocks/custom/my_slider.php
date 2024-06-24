<?php /**
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
    <div class="content-slider content-block" x-data="contentSlider">
        <div class="swiper main-swiper" x-ref="mainSwiper">
            <div class="swiper-wrapper" x-data="fancyboxGallery">
                <?php foreach ($images as $image): ?>
                    <div class="swiper-slide">
                        <a class="img-wrap" data-fancybox="slider-gallery" href="<?= $image['ORIGIN_SRC'] ?>">
                            <img class="img" src="<?= $image['SRC'] ?>" alt="<?= $image['DESCRIPTION'] ?>">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="flex justify-between items-center mt-[1rem] xl:mt-[2.67rem]">
            <button class="slider-arrow shrink-0 prev" x-ref="prev">
                <svg class="icon">
                    <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-to-left"></use>
                </svg>
            </button>
            <div class="w-[60%] grow-1 basis-auto mx-[.5rem] xl:mx-[1.33rem]">
                <div class="swiper thumbs-swiper" x-ref="thumbsSwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $image): ?>
                            <div class="swiper-slide">
                                <div class="img-wrap">
                                    <img class="img" src="<?= $image['SRC'] ?>" alt="<?= $image['DESCRIPTION'] ?>">
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <button class="slider-arrow shrink-0 next" x-ref="next">
                <svg class="icon">
                    <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arr-to-left"></use>
                </svg>
            </button>
        </div>
    </div>
<?php endif ?>