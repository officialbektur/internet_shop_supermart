<template>
	<div ref="fancybox_container">
		<slot></slot>
	</div>
</template>
<script>
	import { Fancybox } from '@fancyapps/ui';
	import '@fancyapps/ui/dist/fancybox/fancybox.css';

	export default {
		mounted() {
			Fancybox.bind(this.$refs.fancybox_container, '[data-fancybox]', {
				...({
					Thumbs: {
						type: 'classic'
					},
					Hash: false,
					Toolbar: {
						display: {
							left: ['infobar'],
							middle: [
								'zoomIn',
								'zoomOut',
								'toggle1to1',
								'rotateCCW',
								'rotateCW',
								'flipX',
								'flipY',
							],
							right: ['slideshow', 'fullscreen', 'thumbs', 'close'],
						},
					},
					Carousel: {
						timeout: 1000,
						infinite: true,
						transition: 'crossfade',
					},
				}),
			});
		},
		updated() {
			Fancybox.unbind(this.$refs.container);
			Fancybox.close();

			Fancybox.bind('[data-fancybox="gallery"]', {
				caption: (fancybox, slide) => {
					const caption = slide.caption || "";

					return `${slide.index + 1} / ${
						fancybox.carousel?.slides.length
					} <br /> ${caption}`;
				},
			});
		},
		unmounted() {
			Fancybox.destroy();
		},
	};
</script>