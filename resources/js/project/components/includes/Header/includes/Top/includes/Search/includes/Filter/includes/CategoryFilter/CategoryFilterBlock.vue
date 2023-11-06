<template>
	<div class="header-top-search-filter-menu__item">
		<div class="header-top-search-filter-menu-item__title">
			Категория
		</div>
		<category-block></category-block>
	</div>
</template>

<script>
	import CategoryBlock from './includes/Category/CategoryBlock.vue';
	export default {
		name: 'CategoryFilterBlock',
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