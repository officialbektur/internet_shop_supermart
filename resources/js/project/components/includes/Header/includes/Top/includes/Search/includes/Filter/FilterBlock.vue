<template>
	<div class="header-top-search__filter header-top-search-filter" :class="{ '_active': isActiveFilter }">
		<button @click="toggleFilter" type="button" class="header-top-search-filter__button header-top-search-filter-button a-hover-bgc">
			<span class="header-top-search-filter-button__icon">
				<svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" fill-rule="evenodd" d="M8 9.83a3.001 3.001 0 10-2 0V19a1 1 0 102 0V9.83zm9 4.34a3.001 3.001 0 11-2 0V5a1 1 0 112 0v9.17z" clip-rule="evenodd"/></svg>
			</span>
		</button>
		<div class="header-top-search-filter__menu header-top-search-filter-menu">
			<button @click="closeFilter" type="button" class="header-top-search-filter-menu__close header-top-search-filter-menu-close a-hover-bgc">
				<span class="header-top-search-filter-menu-close__icon">
					<svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256l105.3-105.4z"/></svg>
				</span>
			</button>
			<div class="header-top-search-filter-menu__items">
				<category-filter-block></category-filter-block>
				<price-block></price-block>
				<sorting-block></sorting-block>
				<div class="header-top-search-filter-menu__item header-top-search-filter-menu-item">
					<div class="header-top-search-filter-menu-item__innerbuttonsave">
						<button @click.prevent="$store.dispatch('sendSearch')" type="button" class="header-top-search-filter-menu-item__buttonsave a-hover-bgc">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import * as flsFunctions from "@/project/files/functions.js";

	import CategoryFilterBlock from './includes/CategoryFilter/CategoryFilterBlock.vue';
	import PriceBlock from './includes/Price/PriceBlock.vue';
	import SortingBlock from './includes/Sorting/SortingBlock.vue';

	export default {
		name: 'FilterBlock',
		data() {
			return {
				isActiveSubMenu: false,
				clickListenerAdded: false,
				isActiveFilter: false,
			};
		},
		mounted() {
			if (!this.clickListenerAdded) {
				this.addClickListener();
				this.clickListenerAdded = true;
			}
		},
		updated() {
		},
		beforeDestroy() {
			this.removeClickListener();
		},
		methods: {
			addClickListener() {
				document.documentElement.addEventListener("click", this.handleWindowClick);
			},
			removeClickListener() {
				document.documentElement.removeEventListener("click", this.handleWindowClick);
			},
			handleWindowClick(e) {
				const el = e.target;
				if (this.isActiveFilter && !el.closest(".header-top-search-filter__menu") && !el.closest(".header-top-search-filter__button")) {
					this.isActiveFilter = false;
				}
				if (this.isSubMenuIcon(e.target)) {
					this.toggleSubMenu(e.target);
				}
			},
			isSubMenuIcon(target) {
				return target.classList.contains('bkt-catygory-menu-main-sublist__button');
			},
			toggleSubMenu(target) {
				const submenu = target.nextElementSibling;
				const parent = target;
				if (!submenu.classList.contains("_slide")) {
					flsFunctions._slideToggle(submenu);
					parent.classList.toggle('_active');
				}
			},
			toggleFilter() {
				this.isActiveFilter = !this.isActiveFilter;
			},
			closeFilter() {
				this.isActiveFilter = false;
			},
		},
		components: {
			'category-filter-block': CategoryFilterBlock,
			'price-block': PriceBlock,
			'sorting-block': SortingBlock,
		},
    }
</script>

<style scoped>
</style>