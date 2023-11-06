<template>
	<div class="header-top__bar header-top-bar">
		<favorite-block></favorite-block>
		<trash-block></trash-block>
		<button type="button" class="header-top-bar__menu header-top-bar-menu">
			<span class="header-top-bar-menu__icon">
				<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M0 96c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm448 160c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32 14.3 32 32z"/></svg>
			</span>
		</button>
	</div>
</template>

<script>
	import FavoriteBlock from './includes/Favorite/FavoriteBlock.vue';
	import TrashBlock from './includes/Trash/TrashBlock.vue';
	export default {
		name: 'BarBlock',
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
			'favorite-block': FavoriteBlock,
			'trash-block': TrashBlock,
		},
    }
</script>

<style scoped>
</style>