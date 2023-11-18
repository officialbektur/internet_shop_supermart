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