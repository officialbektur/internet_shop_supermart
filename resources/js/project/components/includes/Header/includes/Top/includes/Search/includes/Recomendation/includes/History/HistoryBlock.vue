<template>
	<div class="header-top-search-hint__history header-top-search-hint-history">
		<div class="header-top-search-hint__headertop header-top-search-hint-headertop">
			<div class="header-top-search-hint-headertop__title">
				История
			</div>
			<button type="button" @click="$store.dispatch('buttonClearHistories')" class="header-top-search-hint-headertop__clear a-hover-bgc">Очистить</button>
		</div>
		<div class="header-top-search-hint__menu header-top-search-hint-menu">
			<template v-if="histories.length > 0">
				<div v-for="(history, index) in histories.slice(0, 5)" :key="index" @click="$store.dispatch('addHintSearch', history)" class="header-top-search-hint-menu__list a-hover-bgc">{{ history }}</div>
			</template>
			<template v-else>
				<div class="header-top-search-hint-menu__notlist">История пусто</div>
			</template>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
    export default {
		name: 'HistoryBlock',

		data() {
			return {
			};
		},
		mounted() {

		},
		methods: {
		},
		computed: {
			histories() {
				return this.$store.getters.saveDataSearch
			}
		},
		components: {
		}
    }
</script>