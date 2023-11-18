<template>
	<vue-progress-bar class="progress-bar__result"></vue-progress-bar>

	<header-component></header-component>
	<main class="page">
		<router-view :key="$route.fullPath"></router-view>
	</main>
	<sidbar-component></sidbar-component>
	<footer-component></footer-component>
	<popup-address-component></popup-address-component>
	
</template>

<script>
import axios from 'axios';
import { popup } from '@/project/libs/popup.js';
import * as flsFunctions from "@/project/files/functions.js";

import HeaderComponent from './includes/Header/HeaderComponent.vue';
import SidbarComponent from './includes/Sidbar/SidbarComponent.vue';
import FooterComponent from './includes/Footer/FooterComponent.vue';
import AddressPopup from './includes/Popup/AddressPopup.vue';

export default {
	name: 'Index',
	data() {
		return {
			clickListenerAdded: false,
		};
	},
	computed: {
	},
	mounted() {
		this.$Progress.finish();
		this.$store.dispatch("getApp");
		this.$store.dispatch('initCountSaveTovars')
		this.$store.dispatch('scanLocalStorageSearch');
		popup;
	},
	created() {
		this.$Progress.start();
		this.$router.beforeEach((to, from, next) => {
			if (to.meta.progress !== undefined) {
				let meta = to.meta.progress;
				this.$Progress.parseMeta(meta);
			}
			this.$Progress.start();
			next();
		});
		this.$router.afterEach((to, from) => {
			this.$Progress.finish();
		});
	},
	updated() {
		if (!this.clickListenerAdded) {
			this.addClickListener();
			this.clickListenerAdded = true;
		}
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
			if (this.$store.getters.isActiveMenu && !el.closest(".header-footer__menu")) {
				this.$store.commit("setIsActiveMenu", false);
			}
			if (el.closest('.header-footer-menu-sublist-button__icon')) {
				const submenu = el.parentElement.nextElementSibling;
				const parent = el.parentElement.parentElement;
				if (!submenu.classList.contains("_slide")) {
					flsFunctions._slideToggle(submenu);
					parent.classList.toggle('_active');
				}
			}
			if (this.$store.getters.isActiveSearchHint && !el.closest(".header-top-search__hint") && !el.closest(".header-top-search__input")) {
				this.$store.commit("setIsActiveSearchHint", false)
			}
			if (this.$store.getters.isActiveSearch && !el.closest(".mb-footer-sidbar__search") && !el.closest(".header-top-search__hint") && !el.closest(".header-top-search__form")) {
				flsFunctions.bodyUnlock()
				this.$store.commit("setIsActiveSearch", false);
			}
			if (flsFunctions.bodyLockStatus && el.closest(".header-top-bar__menu")) {
				flsFunctions.bodyLockToggle();
				document.documentElement.classList.toggle("menu-open");
			}
			if (document.documentElement.classList.contains("menu-open") && el.closest(".header-footer-menu__body") && !el.closest(".header-footer-menu__content")) {
				flsFunctions.bodyLockToggle();
				document.documentElement.classList.toggle("menu-open");
			}
		},
	},
	components: {
		'header-component': HeaderComponent,
		'sidbar-component': SidbarComponent,
		'footer-component': FooterComponent,
		'popup-address-component': AddressPopup,
	},
};
</script>

<style scoped lang="scss">
</style>