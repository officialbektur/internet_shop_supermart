<template>
	<router-link :to="{ name: 'categoryspecifications.specifications', params: { id: category.id } }" v-if="!category.children" class="block-list">
		<div class="block-list__button">
			<div class="block-list__name block-list__title">
				{{ category.name }}
			</div>
			<div class="block-list__icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
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
			<router-link :to="{ name: 'categoryspecifications.specifications', params: { id: category.id } }" class="block-list__default block-list-default block-list">
				<div class="block-list__name block-list-default__title">
					Посмотреть связь с категорием: {{ category.name }}
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