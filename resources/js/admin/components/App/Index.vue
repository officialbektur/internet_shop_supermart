<template>
	<preloader :class="{ '_hidde': isPreloader }"></preloader>
	<div class="block">
		<h2 class="block__title">Приложение</h2>

		<div class="page__content admin-app">
			<logo-component></logo-component>
			<adress-component></adress-component>
			<email-component></email-component>
			<telephone-component></telephone-component>
			<soc-component></soc-component>
			<plan-work-component></plan-work-component>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	import * as flsFunctions from "@/admin/files/functions.js";

	import Preloader from './../includes/PreloaderComponent.vue';

	import LogoComponent from "./includes/logo/IndexComponent.vue";
	import AdressComponent from "./includes/adress/IndexComponent.vue";
	import EmailComponent from "./includes/email/IndexComponent.vue";
	import TelephoneComponent from "./includes/telephone/IndexComponent.vue";
	import SocComponent from "./includes/soc/IndexComponent.vue";
	import PlanWorkComponent from "./includes/plan_work/IndexComponent.vue";
	export default {
		name: 'Index',
		beforeCreate() {
			document.documentElement.classList.add('lock');
		},
		data() {
			return {
				isPreloader: false,

				app: [],
			}
		},
		mounted() {
			this.getApp()
		},
		methods: {
			preloader() {
				document.documentElement.classList.remove('lock');
				this.isPreloader = true;
			},
			spollers(event) {
				let button = event.target;

				if (!button.nextElementSibling.classList.contains("_slide")) {
					flsFunctions._slideToggle(button.nextElementSibling)

					button.classList.toggle("_show")
				}
			},
			async getApp() {
				try {
					let response = await API.get('/api/admin/app');
					if (response && response.data) {
						this.app = response.data;
					}
				} catch (error) {
				}
				this.preloader();
			},
		},
		computed: {

		},
		components: {
			'preloader': Preloader,
			'logo-component': LogoComponent,
			'adress-component': AdressComponent,
			'email-component': EmailComponent,
			'telephone-component': TelephoneComponent,
			'soc-component': SocComponent,
			'plan-work-component': PlanWorkComponent,
		}
	}
</script>