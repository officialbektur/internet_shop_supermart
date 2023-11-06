// Подключение функционала "Чертогов Фрилансера"
import { isMobile } from "./functions.js";
// Подключение списка активных модулей
import { flsModules } from "./modules.js";

/*
Документация по работе в шаблоне: https://www.lightgalleryjs.com/docs/
Документация плагина: https://www.lightgalleryjs.com/docs/
Сниппет(HTML):
*/

// Подключение базового набора функционала
import lightGallery from 'lightgallery';

// Плагины
// lgZoom, lgAutoplay, lgComment, lgFullscreen, lgHash, lgPager, lgRotate, lgShare, lgThumbnail, lgVideo, lgMediumZoom
// import lgZoom from 'lightgallery/plugins/zoom/lg-zoom.min.js'
import lgFullscreen from 'lightgallery/plugins/fullscreen/lg-fullscreen.min.js'
import lgPager from 'lightgallery/plugins/pager/lg-pager.min.js'
import lgRotate from 'lightgallery/plugins/rotate/lg-rotate.min.js'
import lgVideo from 'lightgallery/plugins/video/lg-video.min.js'
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.min.js'

// Базовые стили
import 'lightgallery/scss/lightgallery.scss';
// Стили дополнений
// import 'lightgallery/scss/lg-zoom.scss';
import 'lightgallery/scss/lg-fullscreen.scss';
import 'lightgallery/scss/lg-pager.scss';
import 'lightgallery/scss/lg-rotate.scss';
import 'lightgallery/scss/lg-video.scss';
import 'lightgallery/scss/lg-thumbnail.scss';
// import 'lightgallery/scss/lg-autoplay.scss';
// import 'lightgallery/scss/lg-share.scss';
// import 'lightgallery/scss/lg-comments.scss';s
// import 'lightgallery/scss/lg-medium-zoom.scss';
// import 'lightgallery/scss/lg-relative-caption.scss';

// Все стили
// import 'lightgallery/scss/lightgallery-bundle.scss';

// Запуск
export function galleries() {
	const galleries = document.querySelectorAll('[data-gallery]');
	if (galleries.length) {
		let galleyItems = [];
		galleries.forEach(gallery => {
			galleyItems.push({
				gallery,
				galleryClass: lightGallery(gallery, {
					plugins: [lgFullscreen, lgPager, lgRotate, lgVideo, lgThumbnail],
					licenseKey: '7EC452A9-0CFD441C-BD984C7C-17C8456E',
					speed: 500,
				})
			})
		});
	}
}