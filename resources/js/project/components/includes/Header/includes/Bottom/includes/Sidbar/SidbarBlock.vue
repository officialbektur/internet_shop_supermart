<template>
	<div class="header-footer__swiper">
		<swiper
			:modules="modules"
			:slides-per-view="'auto'"
			:speed="400"
			:mousewheel="true"
			:freeMode="true"
			:navigation="{ nextEl: '.header-footer-slider__btnnext', prevEl: '.header-footer-slider__btnprev' }"
			class="header-footer__slider header-footer-slider">
			<template v-slot:wrapper-start>
				<router-link :to="{ name: 'index' }" class="header-footer-slider__list swiper-slide a-hover-bgc">Главная</router-link>
				<router-link :to="{ name: 'discounts' }" class="header-footer-slider__list swiper-slide a-hover-bgc">Акция</router-link>
				<router-link :to="{ name: 'histories' }" class="header-footer-slider__list swiper-slide a-hover-bgc">Вы недавно смотрели</router-link>
				<router-link :to="{ name: 'nowproducts' }" class="header-footer-slider__list swiper-slide a-hover-bgc">Новые товары</router-link>
				<router-link :to="{ name: 'hits' }" class="header-footer-slider__list swiper-slide a-hover-bgc">Часто покупают</router-link>
				<router-link :to="{ name: 'abouts' }" class="header-footer-slider__list swiper-slide a-hover-bgc">О нас</router-link>
			</template>
			<template v-slot:container-end>
				<button type="button" class="header-footer-slider__btnnext header-footer-slider-btnnext">
					<span class="header-footer-slider-btnnext__icon a-hover-bgc">
						<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
							<path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z" />
						</svg>
					</span>
					</button>
				<button type="button" class="header-footer-slider__btnprev header-footer-slider-btnprev">
					<span class="header-footer-slider-btnprev__icon a-hover-bgc">
						<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
							<path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z" />
						</svg>
					</span>
				</button>
			</template>
		</swiper>
	</div>
</template>

<script>
	import { FreeMode, Navigation, Mousewheel } from 'swiper/modules';
	import { Swiper } from 'swiper/vue';

	export default {
		name: 'SidbarBlock',
		components: {
			'swiper': Swiper,
		},
		setup() {
			return {
				modules: [FreeMode, Navigation, Mousewheel],
			};
		},
	};
</script>

<style scoped>
</style>
