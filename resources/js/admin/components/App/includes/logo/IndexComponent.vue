<template>
	<div class="block">
		<div class="block__title">Изменить Логотип</div>
		<div class="block__content block__form block-form">
		</div>
	</div>
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