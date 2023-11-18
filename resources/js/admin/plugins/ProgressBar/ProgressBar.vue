<template>
	<div v-if="isProgress" class="progress-bar">
		<div :style="{ 'width': progress + '%' }" class="progress-bar__result"></div>
	</div>
</template>

<script>
	export default {
		name: 'ProgressBar',
		props: {
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
			isProgress() {
				return this.$store.getters.isProgress
			},
			progress() {
				return this.$store.getters.progress
			},
		},
		components: {},
	};
</script>
