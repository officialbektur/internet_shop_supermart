<template>
	<router-link :to="{ name: 'index' }" class="header-top__logo">
		<img :src="'/storage/project/logo/logo.png'" alt="logo">
	</router-link>
</template>


<script>
	export default {
		name: 'LogoBlock',
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
		components: {
		},
    }
</script>

<style scoped>
</style>