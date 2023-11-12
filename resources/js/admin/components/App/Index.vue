<template>
	<h2 class="_title">Приложение</h2>

	<div class="page__content admin-app">
		<logo-component></logo-component>
		<adress-component></adress-component>
	</div>
</template>

<script>
	import API from '@/admin/api';
	import LogoComponent from "./includes/logo/IndexComponent.vue";
	import AdressComponent from "./includes/adress/IndexComponent.vue";
	export default {
		name: 'Index',
		data() {
			return {
				app: []
			}
		},
		mounted() {
			this.getApp()
		},
		methods: {
			async getApp() {
				try {
					let response = await API.get('/api/admin/app');
					if (response && response.data) {
						this.app = response.data;
					}
				} catch (error) {
				}
			},
		},
		computed: {

		},
		components: {
			'logo-component': LogoComponent,
			'adress-component': AdressComponent,
		}
	}
</script>