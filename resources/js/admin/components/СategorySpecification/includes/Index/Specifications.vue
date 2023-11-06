<template>
	<div v-if="!specification.children" class="block-list">
		<div class="block-list__name block-list__title">
			{{ specification.name }}
		</div>
	</div>
	<div v-else class="block-sublist">
		<div class="block-sublist__button">
			<div class="block-list__name block-sublist__title">
				{{ specification.name }}
			</div>
			<div class="block-sublist__icon">
				<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
			</div>
		</div>
		<div hidden class="block-sublist__menu">
			<!-- <div class="block-list__default block-list-default block-list">
				<div class="block-list__name block-list-default__title">
					Посмотреть связь с категорием: {{ specification.name }}
				</div>
			</div> -->
			<specifications v-for="specification in specification.children" :specification="specification" :key="specification"></specifications>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'block-sublist',
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