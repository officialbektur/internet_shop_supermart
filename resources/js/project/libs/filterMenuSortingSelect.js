import * as flsFunctions from "./../files/functions.js";

function filterMenuSortingSelect() {
	if (document.querySelector(".header-top-search-filter-menu-item-sorting-select__button")) {
		let button = document.querySelector(".header-top-search-filter-menu-item-sorting-select__button");
		button.nextElementSibling.hidden = "true";
		button.addEventListener('click', function (e) {
			if (!button.classList.contains("_slide")) {
				flsFunctions._slideToggle(document.querySelector(".header-top-search-filter-menu-item-sorting-select__menu"));
				button.classList.toggle("_active");
			}
		});
		let menulist = document.querySelectorAll(".header-top-search-filter-menu-item-sorting-select-menu__list");
		for (let index = 0; index < menulist.length; index++) {
			let element = menulist[index];
			element.addEventListener("click", function (e) {
				if (!button.nextElementSibling.classList.contains("_slide")) {
					for (let index = 0; index < menulist.length; index++) {
						let indexs = menulist[index];
						indexs.classList.remove("_active");
					}
					this.classList.add("_active");
					button.querySelector(".header-top-search-filter-menu-item-sorting-select-button__title").innerText = this.innerText;
					flsFunctions._slideUp(button.nextElementSibling);
					button.classList.toggle("_active");
				}
			});
		}
	}
}