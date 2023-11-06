<template>
	<div class="header-footer__menu header-footer-menu">
		<button @click.prevent="$store.dispatch('toggleMenu')" type="button" class="header-footer-menu__button header-footer-menu-button">
			<span class="header-footer-menu-button__title">Категория</span>
			<span class="header-footer-menu-button__icon">
				<svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" fill-rule="evenodd" d="M8 9.83a3.001 3.001 0 10-2 0V19a1 1 0 102 0V9.83zm9 4.34a3.001 3.001 0 11-2 0V5a1 1 0 112 0v9.17z" clip-rule="evenodd"/></svg>
			</span>
		</button>
		<div class="header-footer-menu__body" :class="{ '_active': $store.getters.isActiveMenu }">
			<div v-if="$store.getters.categories.length > 0" class="header-footer-menu__content">
				<category-block v-for="category in $store.getters.categories" :category="category" :key="category"></category-block>
			</div>
			<div v-else class="header-footer-menu__list">Нету данных!</div>
		</div>
	</div>
</template>

<script>
	import CategoryBlock from './includes/Category/CategoryBlock.vue';

	export default {
		name: 'MenuCategoryBlock',
		data() {
			return {

			};
		},
		mounted() {
		},
		updated() {

		},
		methods: {

		},
		components: {
			'category-block': CategoryBlock,
		},
    }
</script>

<style scoped>
</style>