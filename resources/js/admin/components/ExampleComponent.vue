<template>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'ExampleComponent',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			async get() {
				try {
					let response = await axios.get('/api/');
					if (response && response.data && response.data.length > 0) {
					} else {
					}
				} catch (error) {
				}
			},
		},
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>