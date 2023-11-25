<template>
	<router-link
		v-if="!category.children"
		:to="{ name: 'search', query: { category_id: category.id } }"
		@click.prevent="$store.dispatch('zeroingHref', { name: 'setCategoryId' , value: category.id })"
		class="header-footer-menu__list a-hover-bgc">
		{{ category.name }}
	</router-link>
	<div v-else class="header-footer-menu__sublist header-footer-menu-sublist">
		<div class="header-footer-menu-sublist__button header-footer-menu-sublist-button a-hover-bgc">
			<router-link
				:to="{ name: 'search', query: { category_id: category.id } }"
				@click.prevent="$store.dispatch('zeroingHref', { name: 'setCategoryId' , value: category.id })"
				class="header-footer-menu-sublist-button__title">
				{{ category.name }}
			</router-link>
			<span class="header-footer-menu-sublist-button__icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
					<path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3l-137.4 137.4c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25C368.4 348.9 360.2 352 352 352z" />
				</svg>
			</span>
		</div>
		<div hidden class="header-footer-menu-sublist__menulist header-footer-menu-sublist-menulist">
			<div class="header-footer-menu-sublist-menulist__content">
				<category-block v-for="category in category.children" :category="category" :key="category"></category-block>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'CategoryBlock',
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
	};
</script>
