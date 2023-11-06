<template>
	<div v-if="hints && hints.length > 0" class="header-top-search-hint__footer header-top-search-hint-footer">
		<div class="header-top-search-hint__headertop">
			<div class="header-top-search-hint-headertop__title">
				Рекомендация
			</div>
		</div>
		<div class="header-top-search-hint__menu header-top-search-hint-menu">
			<div v-for="hint in hints" :key="hint" @click="$store.dispatch('addHintSearch', hint.name)" class="header-top-search-hint-menu__list a-hover-bgc">{{ hint.name }}</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
    export default {
		name: 'HintBlock',

		data() {
			return {
				hints: [],
			};
		},
		mounted() {
			this.getSearchHints();
		},
		methods: {
			async getSearchHints() {
				try {
					let response = await axios.get('/api/searchhints');
					if (response && response.data && response.data.length > 0) {
						this.hints = response.data;
					}
				} catch (error) {
				}
			},
		},

		components: {
		}
    }
</script>