<template>
	<div
		v-if="!category.children"
		class="filter-panel-categories-menu__list filter-panel-categories-menu-list">
		<button
			type="button"
			data-category-link
			@click.prevent="$store.dispatch('addClickCategory',  { id: category.id, event: $event }), $store.commit('setIsActiveMenuFilterPanel', false)"
			class="filter-panel-categories-menu-list__button filter-panel-categories-menu-list-button a-hover-bgc"
			:class="{ '_show': $store.getters.category.some(item => item.id === category.id) }">
				<span class="filter-panel-categories-menu-list-button__title">
					{{ category.name }}
				</span>
		</button>
	</div>
	<div
		v-else
		data-category-submenu
		class="filter-panel-categories-menu__sublist filter-panel-categories-menu-sublist">
		<button
			type="button"
			data-category-button
			class="filter-panel-categories-menu-sublist__button filter-panel-categories-menu-sublist-button a-hover-bgc"
			:class="{ '_show': $store.getters.category.some(item => item.id === category.id) }">
				<span class="filter-panel-categories-menu-sublist-button__title">
					{{ category.name }}
				</span>
				<span class="filter-panel-categories-menu-sublist-button__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
						<path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3l-137.4 137.4c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25C368.4 348.9 360.2 352 352 352z" />
					</svg>
				</span>
		</button>
		<div
			:hidden="!$store.getters.category.some(item => item.id === category.id)"
			class="filter-panel-categories-menu-sublist__menulist filter-panel-categories-menu-sublist-menulist">
			<div class="filter-panel-categories-menu__defaultlist filter-panel-categories-menu-defaultlist">
				<button
					type="button"
					data-category-link-default
					@click.prevent="$store.dispatch('addClickCategory',  { id: category.id, event: $event}), $store.commit('setIsActiveMenuFilterPanel', false)"
					class="filter-panel-categories-menu-defaultlist__button filter-panel-categories-menu-defaultlist-button a-hover-bgc">
					Всё в категории <span class="filter-panel-categories-menu-defaultlist-button__categoryname">{{ category.name }}</span>
				</button>
			</div>
			<categories v-for="category in category.children" :category="category" :key="category"></categories>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'Categories',
		props: {
			category: Object,
		},
		data() {
			return {
			};
		},
		mounted() {
		},
		methods: {
		},
		updated() {
		}
	};
</script>
<script setup>
</script>