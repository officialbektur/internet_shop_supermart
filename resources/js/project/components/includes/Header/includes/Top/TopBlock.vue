<template>
	<div class="header__top header-top">
		<div class="header-top__container">
			<div class="header-top__body d-flex justify-content-between align-items-center">
				<logo-block></logo-block>
				<search-block></search-block>
				<bar-block></bar-block>
			</div>
		</div>
	</div>
</template>

<script>
	import LogoBlock from './includes/Logo/LogoBlock.vue';
	import SearchBlock from './includes/Search/SearchBlock.vue';
	import BarBlock from './includes/Bar/BarBlock.vue';

	export default {
		name: 'TopBlock',
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
			'logo-block': LogoBlock,
			'search-block': SearchBlock,
			'bar-block': BarBlock,
		},
    }
</script>

<style scoped>
</style>