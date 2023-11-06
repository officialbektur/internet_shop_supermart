<template>
	<div class="header__footer header-footer">
		<div class="header-footer__container">
			<div class="header-footer__body">
				<menu-category-block></menu-category-block>
				<div class="header-footer__content">
					<sidbar-block></sidbar-block>
					<map-block></map-block>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import MenuCategoryBlock from './includes/MenuCategory/MenuCategoryBlock.vue';
	import SidbarBlock from './includes/Sidbar/SidbarBlock.vue';
	import MapBlock from './includes/Map/MapBlock.vue';

	export default {
		name: 'BottomBlock',
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
			'menu-category-block': MenuCategoryBlock,
			'sidbar-block': SidbarBlock,
			'map-block': MapBlock,
		},
    }
</script>

<style scoped>
</style>