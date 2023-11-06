<template>
	<template v-if="$store.getters.category.length > 0 ? category.id !== $store.getters.category[$store.getters.category.length - 1].id : true">
		<li
			data-close
			data-category-link
			v-if="!category.children"
			@click.prevent="$store.dispatch('addClickCategory',  { id: category.id, event: $event})"
			class="block-list"
			:class="{ '_show': $store.getters.category.some(item => item.id === category.id) }">
			<div class="block-list__name block-list__title">
				{{ category.name }}
			</div>
		</li>
		<li v-else data-category-submenu class="block-sublist">
			<div
				data-category-button
				class="block-sublist__button"
				:class="{ '_show': $store.getters.category.some(item => item.id === category.id) }">
				<div class="block-list__name block-sublist__title">
					{{ category.name }}
				</div>
				<div class="block-sublist__icon">
					<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
				</div>
			</div>
			<ul :hidden="!$store.getters.category.some(item => item.id === category.id)" class="block-sublist__menu">
				<li
					data-close
					data-category-link-default
					@click.prevent="$store.dispatch('addClickCategory',  { id: category.id, event: $event})"
					class="block-list__default block-list-default block-list">
					<div class="block-list__name block-list-default__title">
						Вставить в эту категорию {{ category.name }}
					</div>
				</li>
				<categories v-for="category in category.children" :category="category" :key="category"></categories>
			</ul>
		</li>
	</template>
</template>

<script>
	export default {
		name: 'Category',
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