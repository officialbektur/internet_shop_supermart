<template>
	<div class="header-top__search header-top-search d-flex" :class="{ '_show': isActiveSearch }">
		<form action="" method="get" class="header-top-search__form">
			<input
				autocomplete="off"
				type="text"
				placeholder="Искать на сайте..."
				@input="withSearchInput($event)"
				@focus="focusSearchInput"
				:value="$store.getters.searchInput"
				class="header-top-search__input">
			<clear-button-block></clear-button-block>
			<filter-block></filter-block>
			<button @click.prevent="$store.dispatch('sendSearch')" type="submit" class="header-top-search__button">Поиск</button>
		</form>
		<div class="header-top-search__hint header-top-search-hint" :class="{ '_active': $store.getters.isActiveSearchHint }">
			<div class="header-top-search-hint__body">
				<recomendation-block></recomendation-block>
			</div>
		</div>
	</div>
</template>

<script>
	import ClearButtonBlock from './includes/ClearButton/ClearButtonBlock.vue';
	import FilterBlock from './includes/Filter/FilterBlock.vue';
	import RecomendationBlock from './includes/Recomendation/RecomendationBlock.vue';

	export default {
		name: 'SearchBlock',
		data() {
			return {
			}
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			withSearchInput(event) {
				this.$store.commit('setSearchInput', event.target.value.trim())
			},
			focusSearchInput() {
				this.$store.commit('setIsActiveSearchHint', true)
			},
		},
		computed: {
			isActiveSearch() {
				return this.$store.getters.isActiveSearch
			}
		},
		components: {
			'clear-button-block': ClearButtonBlock,
			'filter-block': FilterBlock,
			'recomendation-block': RecomendationBlock,
		},
    }
</script>

<style scoped>
</style>