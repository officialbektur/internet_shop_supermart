<template>
	<div class="header-top-search-filter-menu__item header-top-search-filter-menu-item">
		<div class="header-top-search-filter-menu-item__title">
			Цена
		</div>
		<div class="header-top-search-filter-menu-item__content header-top-search-filter-menu-item__price header-top-search-filter-menu-item-price">
			<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
				<input
					autocomplete="off"
					type="number"
					id="1"
					placeholder="Цена от"
					@input="withMaxPrice($event)"
					:value="formattedMaxPrice"
				/>
			</div>
			<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
				<input
					autocomplete="off"
					type="number"
					id="2"
					placeholder="Цена до"
					@input="withMinPrice($event)"
					:value="formattedMinPrice"/>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'PriceBlock',
	computed: {
		formattedMaxPrice() {
			return this.$store.getters.maxPrice;
		},
		formattedMinPrice() {
			return this.$store.getters.minPrice;
		},
	},
	methods: {
		withMaxPrice(event) {
			let input = event.target.value.replace(/\D/g, '');
			let value = input.length > 0 ? input : event.target.value.length > 0 ? this.$store.getters.maxPrice : '';
			this.$store.commit('setMaxPrice', value);
		},
		withMinPrice(event) {
			let input = event.target.value.replace(/\D/g, '');
			let value = input.length > 0 ? input : event.target.value.length > 0 ? this.$store.getters.minPrice : '';
			this.$store.commit('setMinPrice', value);
		},
	},
};
</script>

<style scoped>
</style>
