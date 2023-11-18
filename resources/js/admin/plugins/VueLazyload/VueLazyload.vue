<template>
	<img :data-src="dataSrc" :src="currentSrc" @error="handleImageError($event)" v-if="alt" :alt="alt">
	<img :data-src="dataSrc" :src="currentSrc" @error="handleImageError($event)" v-else>
</template>

<script>
	import LazyLoad from "vanilla-lazyload";
	export default {
		name: 'VueLazyload',
		props: {
			src: {
				type: [String, Object],
				default: null,
			},
			dataSrc: [String, Object],
			error: {
				type: [String, Object],
				default: null,
			},
			alt: {
				type: String,
				default: null,
			},
		},
		data() {
			return {
				currentSrc: this.src || null,
			};
		},
		mounted() {
			const lazyMedia = new LazyLoad({
				elements_selector: '[data-src],[data-srcset]',
				class_loaded: '_lazy-loaded',
				use_native: true,
			});
			lazyMedia.update();
		},
		updated() {
		},
		methods: {
			handleImageError(event) {
				let src = this.error || this.src || null;
				event.target.src = src;
			},
		},
		computed: {},
		components: {},
	};
</script>
