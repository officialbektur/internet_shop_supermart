/*
Документация по работе в шаблоне:
Документация слайдера: https://swiperjs.com/
Сниппет(HTML): swiper
*/

// Подключаем слайдер Swiper из node_modules
// При необходимости подключаем дополнительные модули слайдера, указывая их в {} через запятую
// Пример: { Navigation, Autoplay }
import Swiper from 'swiper';
import { Navigation, Mousewheel, Thumbs, HashNavigation } from 'swiper/modules';
// Install the modules
Swiper.use([Navigation, Mousewheel, Thumbs, HashNavigation]);
/*
Основниые модули слайдера:
Navigation, Pagination, Autoplay,
EffectFade, Lazy, Manipulation
Подробнее смотри https://swiperjs.com/
*/

// Стили Swiper
// Базовые стили
import "./../../../sass/project/base/_swiper.scss";
// Полный набор стилей из sass/project/libs/_swiper.scss
// import "./../../../sass/project//libs/_swiper.scss";
// Полный набор стилей из node_modules
// import 'swiper/css';

// Инициализация слайдеров
export function initSliders() {
	// Перечень слайдеров
	if (document.querySelector('.header-footer__slider')) {
		new Swiper('.header-footer__slider', {
			// Подключаем модули слайдера
			// для конкретного случая
			modules: [Navigation, Mousewheel],
			slidesPerView: "auto",
			speed: 400,
			mousewheel: true,
			freeMode: true,
			// navigation
			navigation: {
				nextEl: ".header-footer-slider__btnnext",
				prevEl: ".header-footer-slider__btnprev",
			},
			on: {

			}
		});
	}
	if (document.querySelector('.moreinfo-tovar-info-image__pagination')) {
		var swiper = new Swiper(".moreinfo-tovar-info-image__pagination", {
			modules: [Navigation, Mousewheel],
			// lazy: true,
			// loop: true,
			slidesPerView: "auto",
			spaceBetween: 3,
			speed: 400,
			mousewheel: true,
			freeMode: true,
			watchSlidesProgress: true,
			// navigation
			navigation: {
				nextEl: ".moreinfo-tovar-info-image-pagination__prev",
				prevEl: ".moreinfo-tovar-info-image-pagination__next",
			},
		});
		if (document.querySelector('.moreinfo-tovar-info-image__sliderbig')) {
			new Swiper(".moreinfo-tovar-info-image__sliderbig", {
				modules: [Navigation, Thumbs, HashNavigation],
				// loop: true,
				hashNavigation: {
					watchState: true,
				},
				spaceBetween: 0,
				speed: 400,
				// freeMode: true,
				// navigation
				navigation: {
					nextEl: ".moreinfo-tovar-info-image-sliderbig-pagination__prev",
					prevEl: ".moreinfo-tovar-info-image-sliderbig-pagination__next",
				},
				thumbs: {
					swiper: swiper,
				},
			});
		}
	}
	if (document.querySelector('.moreinfo-tovar__alsorecommend .product-block-slids')) {
		new Swiper(".moreinfo-tovar__alsorecommend .product-block-slids", {
			modules: [Navigation],
			// loop: true,
			slidesPerView: "auto",
			spaceBetween: 0,
			speed: 400,
			freeMode: true,
			// navigation
			navigation: {
				nextEl: ".moreinfo-tovar__alsorecommend .product-block-slids-pagination__prev",
				prevEl: ".moreinfo-tovar__alsorecommend .product-block-slids-pagination__next"
			}
		});
	}
	if (document.querySelector('.moreinfo-tovar__history .product-block-slids')) {
		new Swiper(".moreinfo-tovar__history .product-block-slids", {
			modules: [Navigation],
			// loop: true,
			slidesPerView: "auto",
			spaceBetween: 0,
			speed: 400,
			freeMode: true,
			// navigation
			navigation: {
				nextEl: ".moreinfo-tovar__history .product-block-slids-pagination__prev",
				prevEl: ".moreinfo-tovar__history .product-block-slids-pagination__next"
			}
		});
	}
}
// Скролл на базе слайдера (по классу swiper_scroll для оболочки слайдера)
export function initSlidersScroll() {
	// Добавление классов слайдера
	// при необходимости отключить
	bildSliders();

	let sliderScrollItems = document.querySelectorAll('.swiper_scroll');
	if (sliderScrollItems.length > 0) {
		for (let index = 0; index < sliderScrollItems.length; index++) {
			const sliderScrollItem = sliderScrollItems[index];
			const sliderScrollBar = sliderScrollItem.querySelector('.swiper-scrollbar');
			const sliderScroll = new Swiper(sliderScrollItem, {
				observer: true,
				observeParents: true,
				direction: 'vertical',
				slidesPerView: 'auto',
				freeMode: {
					enabled: true,
				},
				scrollbar: {
					el: sliderScrollBar,
					draggable: true,
					snapOnRelease: false
				},
				mousewheel: {
					releaseOnEdges: true,
				},
			});
			sliderScroll.scrollbar.updateSize();
		}
	}
}

// window.addEventListener("load", function (e) {
// 	// Запуск инициализации слайдеров
// 	initSliders();
// 	// Запуск инициализации скролла на базе слайдера (по классу swiper_scroll)
// 	//initSlidersScroll();
// });