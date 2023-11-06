<template>
	<li v-if="!specification.children" @click.prevent="$store.dispatch('addClickLinkingSpecification', { id: specification.id, event: $event })" class="block__list block-list">
		<div class="block-list__name block-list__title">
			{{ specification.name }}
		</div>
	</li>
	<li v-else class="block-sublist">
		<div class="block-sublist__button">
			<div class=" block-list__name block-sublist__title">
				{{ specification.name }}
			</div>
			<div class="block-sublist__icon">
				<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
			</div>
		</div>
		<ul hidden class="block-sublist__menu">
			<specifications v-for="specification in specification.children" :specification="specification" :key="specification"></specifications>
		</ul>
	</li>
</template>

<script>
	export default {
		name: 'Specifications',
		props: {
			specification: Object,
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