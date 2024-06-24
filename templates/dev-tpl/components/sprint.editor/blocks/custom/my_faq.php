<div class="faq-list">
    <?php foreach ($block["faq"] as $faq): ?>
        <div class="accordion" x-data="Accordion" @click.outside="open = false" :class="open && 'open'">
            <button class="accordion__head" @click="open = !open">
                <p class="accordion__name"><?= $faq["question"] ?></p>
                <svg width="16" height="16" viewBox="0 0 16 16" class="accordion__icon">
                    <path
                        d="M15.2606 8.70992L8.1952 8.70992L8.19521 15.7754L6.77536 15.7754L6.77536 8.70992L-0.290076 8.70992V7.29008L6.77536 7.29008L6.77536 0.224643L8.19521 0.224643L8.1952 7.29008L15.2606 7.29008V8.70992Z" />
                </svg>
            </button>
            <div class="collapse is-collapsed" x-ref="collapse">
                <div class="accordion__content content-text">
                    <?= $faq["answer"] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>