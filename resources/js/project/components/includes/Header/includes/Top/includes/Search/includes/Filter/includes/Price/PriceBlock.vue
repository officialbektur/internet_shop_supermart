<template>
	<div class="header-top-search-filter-menu__item header-top-search-filter-menu-item">
		<div class="header-top-search-filter-menu-item__title">
			Цена
		</div>
		<div class="header-top-search-filter-menu-item__content header-top-search-filter-menu-item__price header-top-search-filter-menu-item-price">
			<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
				<input autocomplete="off" type="text" id="1" placeholder="Цена от" @input="withMaxPrice($event)" :value="$store.getters.maxPrice">
			</div>
			<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
				<input autocomplete="off" type="text" id="2" placeholder="Цена до" @input="withMinPrice($event)" :value="$store.getters.minPrice">
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'PriceBlock',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			withMaxPrice(event) {
				this.$store.commit('setMaxPrice', event.target.value)
			},
			withMinPrice(event) {
				this.$store.commit('setMinPrice', event.target.value)
			},
		},
		components: {
		},
    }
</script>

<style scoped>
</style>