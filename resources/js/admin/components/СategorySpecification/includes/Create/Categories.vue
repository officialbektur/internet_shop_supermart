<template>
	<router-link :to="{ name: 'categoryspecifications.store', params: { id: category.id } }" v-if="!category.children" class="block-list">
		<div class="block-list__button">
			<div class="block-list__name block-list__title">
				{{ category.name }}
			</div>
			<div class="block-list__icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
			</div>
		</div>
	</router-link>
	<div v-else class="block-sublist">
		<div class="block-sublist__button">
			<div class="block-list__name block-sublist__title">
				{{ category.name }}
			</div>
			<div class="block-sublist__icon">
				<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
			</div>
		</div>
		<div hidden class="block-sublist__menu">
			<router-link :to="{ name: 'categoryspecifications.store', params: { id: category.id } }" class="block-list__default block-list-default block-list">
				<div class="block-list__name block-list-default__title">
					Создать связь с категорием: {{ category.name }}
				</div>
			</router-link>
			<categories v-for="category in category.children" :category="category" :key="category"></categories>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'block-sublist',
		props: {
			category: Object,
		},
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
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>