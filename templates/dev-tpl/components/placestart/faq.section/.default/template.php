<?php if ( ! defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true )
	die(); ?>

<section class="faq-section page-block">
	<div class="container title-container">
		<h2 class="title-container__title t-20">Вопросы и ответы</h2>
		<div class="title-container__content">
			<div class="accordion" x-data="Accordion" @click.outside="open = false" :class="open && 'open'">
				<button class="accordion__head" @click="open = !open">
					Как правильно выбрать свой размер?
					<svg class="accordion__icon">
						<use href='<?= SPRITE_PATH ?>#plus'></use>
					</svg>
				</button>
				<div class="collapse is-collapsed" x-ref="collapse">
					<div class="accordion__content content-text">
						<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus unde accusantium voluptatum
							cupiditate consectetur inventore porro autem blanditiis harum placeat!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>