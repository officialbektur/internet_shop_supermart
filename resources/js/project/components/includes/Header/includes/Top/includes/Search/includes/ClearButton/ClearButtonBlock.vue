<template>
	<div :class="{ '_active': $store.getters.searchInput.length > 0 }" class="header-top-search__clear header-top-search-clear a-hover-bgc" @click="$store.dispatch('buttonClearSearchInput')">
		<button type="button" class="header-top-search-clear__button header-top-search-clear-button">
			<span class="header-top-search-clear-button__icon">
				<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
			</span>
		</button>
	</div>
</template>

<script>
	import axios from 'axios';
	export default {
		name: 'ClearButtonBlock',
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
		},
    }
</script>

<style scoped>
</style>