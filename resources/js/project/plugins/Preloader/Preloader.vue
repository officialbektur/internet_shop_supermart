<template>
	<div class="preloader" v-if="rgba" :style="{'background': rgba}">
		<div class="preloader__content">
			<div class="preloader__downloads">
				<div class="preloader__downloads_icon preloader__downloads_icon-first"></div>
				<div class="preloader__downloads_icon preloader__downloads_icon-second"></div>
				<div class="preloader__downloads_icon preloader__downloads_icon-third"></div>
			</div>
		</div>
	</div>
	<div class="preloader" v-else>
		<div class="preloader__content">
			<div class="preloader__downloads">
				<div class="preloader__downloads_icon preloader__downloads_icon-first"></div>
				<div class="preloader__downloads_icon preloader__downloads_icon-second"></div>
				<div class="preloader__downloads_icon preloader__downloads_icon-third"></div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'Preloader',
		props: {
			rgba: {
				type: String,
				default: null,
			},
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
		components: {},
	};
</script>
