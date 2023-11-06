/*
(i) Код попадает в итоговый файл,
только когда вызвана функция,
например flsFunctions.spollers();
Или когда импортирован весь файл,
например import "mycode.js";
Неиспользуемый (не вызванный)
код в итоговый файл не попадает.

Если мы хотим добавить модуль
следует его расскоментировать
*/

// Включить/выключить FLS (Full Logging System) (в работе)
// window['FLS'] = true;

// Подключение основного файла стилей
// import "../scss/style.scss";
// Preloader
// import "./libs/preloader.js";
// ========================================================================================================================================================================================================================================================
// Функционал ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================
import * as flsFunctions from "./files/functions.js";
/* Проверка поддержки webp, добавление класса webp или no-webp для HTML */
/* (i) необходимо для корректного отображения webp из css  */
flsFunctions.isWebp();
flsFunctions.minWindowScreen();
/* Добавление класса _touch для HTML если браузер мобильный а есди пк то _pc*/
flsFunctions.addTouchClass();
/* Добавление loaded для HTML после полной загрузки страницы */
// flsFunctions.addLoadedClass();
/* Модуль для работы с меню (Бургер) */
flsFunctions.polyfillSupportClosest();

/* Учет плавающей панели на мобильных устройствах при 100vh */
// flsFunctions.fullVHfix();
// Выпадающий меню
// flsFunctions.menuListSubLists();
// Progress Bar
// flsFunctions.progressBar();
/*
Модуль работы со спойлерами
Документация:
Сниппет (HTML): spollers
*/
// flsFunctions.spollers();

/*
Модуль работы с табами
Документация:
Сниппет (HTML): tabs
*/
// flsFunctions.tabs();

/*
Модуль "показать еще"
Документация по работе в шаблоне:
Сниппет (HTML): showmore
*/
// flsFunctions.showMore();

/*
Попапы
Документация по работе в шаблоне:
Сниппет (HTML): pl
*/
// import './libs/popup.js'

/*
Модуль параллакса мышью
Документация по работе в шаблоне:
Сниппет (HTML):
*/
// import './libs/parallax-mouse.js'

// ========================================================================================================================================================================================================================================================
// Работа с формами ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================
// import * as flsForms from "./files/forms/forms.js";

/* Работа с полями формы: добавление классов, работа с placeholder. */
// flsForms.formFieldsInit();

/* Oтправка формы со встроенной валидацией полей. false - отключит валидацию */
// flsForms.formSubmit(true);

/* Модуль формы "колличество" */
// flsForms.formQuantity();

/* Модуль формы "показать пароль" */
// flsForms.formViewpass();

/* Модуль звездного рейтинга */
// flsForms.formRating();

/* Модуль работы с select. */
// import './libs/select.js'

/* (В работе) Модуль работы с масками.*/
/*
Подключение и настройка выполняется в файле js/files/forms/inputmask.js
Документация по работе в шаблоне:
Документация плагина: https://github.com/RobinHerbots/inputmask
Сниппет(HTML):
*/
// import "./files/forms/inputmask.js";

/* Модуль работы с ползунком */
/*
Подключение и настройка выполняется в файле js/files/forms/range.js
Документация по работе в шаблоне:
Документация плагина: https://refreshless.com/nouislider/
Сниппет (HTML): range
*/
// import "./files/forms/range.js";

/* Модуль работы с подсказками (tippy) */
/*
Подключение плагина Tippy.js и настройка выполняется в файле js/files/tippy.js
Документация по работе в шаблоне:
Документация плагина: https://atomiks.github.io/tippyjs/
Сниппет (HTML): tip (добавляет атрибут с подсказкой для html тега)
*/
// import "./files/tippy.js";

// ========================================================================================================================================================================================================================================================
// Работа со слайдером (Swiper) ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================
/*
Настройка подключения плагина слайдера Swiper и новых слайдеров выполняется в файле js/files/sliders.js
Документация по работе в шаблоне:
Документация плагина: https://swiperjs.com/
Сниппет(HTML): swiper
*/
// import "./files/sliders.js";

// ========================================================================================================================================================================================================================================================
// Модули работы с прокруткой страницы ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================

/*
Изменение дизайна скроллбара
Документация по работе в шаблоне: В HTML добавляем к блоку атрибут data-simplebar
Документация плагина: https://github.com/Grsmto/simplebar/tree/master/packages/simplebar
Сниппет(HTML):
*/
// import './files/scroll/simplebar.js';

// Ленивая (отложенная) загрузка картинок
// Документация по работе в шаблоне: В HTML добавляем img, video, audio, iframe но вместо src пишем data-src
// Документация плагина: https://github.com/verlok/vanilla-lazyload
// Сниппет(HTML):
//import './files/scroll/lazyload.js';

// Наблюдатель за объектами c атрибутом data-watch
// Документация по работе в шаблоне: js/libs/watcher.js
// Сниппет(HTML):
// import './libs/watcher.js'

// Функции работы скроллом
import * as flsScroll from "./files/scroll/scroll.js";

// Плавная навигация по странице
flsScroll.pageNavigation();

// Функционал добавления классов к хедеру при прокрутке
// flsScroll.headerScroll();

// Функционал липкого блока
// flsScroll.stickyBlock();

// Функционал добавления классов при прокрутке
flsScroll.windowOnScroll();

// ========================================================================================================================================================================================================================================================
// Галерея ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================
/*
Документация по работе в шаблоне: https://www.lightgalleryjs.com/docs/
Документация плагина: https://www.lightgalleryjs.com/docs/
Сниппет(HTML):
*/
// import "./files/gallery.js";

// ========================================================================================================================================================================================================================================================
// Прочие плагины ============================================================================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================

/* Динамический адаптив */
// import "./libs/responce.js";

/* Форматирование чисел */
// import './libs/wNumb.min.js';
// ========================================================================================================================================================================================================================================================
// Прочее ========================================================================================================================================================================================================================================================
// ========================================================================================================================================================================================================================================================
/* Подключаем файлы со своим кодом */
// import "./mycode.js";
function windowsSize() {
	if (document.querySelector(".windows-size__width")) {
		let fz = document.querySelector(".windows-size__fz");
		let ww = document.querySelector(".windows-size__width");
		let hh = document.querySelector(".windows-size__height");
		let fs = Number(
					window
					.getComputedStyle(document.documentElement)
					.getPropertyValue('font-size')
					.match(/\d+/)[0]
				);
		let ws = document.documentElement.offsetWidth;
		let hs = window.innerHeight;
		fz.innerText = fs+" - Шрифт";
		ww.innerText = ws+" - Шир";
		hh.innerText = hs+" - Выс";
	}
}
windowsSize();
/* ====================  Checking the screen resizing  --Start--  ==================== */
window.addEventListener("resize", function () {
	/* ====================  Launching Functions  --Start--  ==================== */
	flsFunctions.addTouchClass();
	flsFunctions.deleteActiveWindowLarger767px();
	flsFunctions.minWindowScreen();
	windowsSize();
	/* ====================  Launching Functions  --End--  ==================== */
});
/* ====================  Checking the screen resizing  --End--  ==================== */
//============================================================================================================================================================================================================================================