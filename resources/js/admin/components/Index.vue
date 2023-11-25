<template>
	<div v-if="!$store.getters.isPreloader" class="loading-lazy"></div>
	<template v-else>
		<vue-progress-bar class="progress-bar__result"></vue-progress-bar>

		<template v-if="$store.getters.isVerify">
			<sidebar-component></sidebar-component>
			<main class="page" :class="{ 'margin-left-sidebar': $store.getters.isVerify}">
				<router-view :key="$route.fullPath"></router-view>
			</main>
		</template>
		<template v-else>
			<main class="page" :class="{ 'df fdc aic': !$store.getters.isVerify }">
				<template v-if="$store.getters.isVerifyLog">
					<reset-component v-if="$store.getters.isResetPassword"></reset-component>
					<login-component v-else></login-component>
				</template>
				<registration-component v-else></registration-component>
			</main>
		</template>
	</template>
</template>

<script>
	import LoginComponent from './User/Login.vue';
	import RegistrationComponent from './User/Registration.vue';
	import ResetPasswordComponent from './User/ResetPassword.vue';

	import SidebarComponent from './includes/SidebarComponent.vue';
	import { popup } from '@/Admin/libs/popup.js';

	export default {
		name: 'Index',
		beforeCreate() {
			document.documentElement.classList.add('lock');
		},
		data() {
			return {
			};
		},
		mounted() {
			if (!localStorage.getItem('access_token') || localStorage.getItem('access_token').length == 0) {
				this.$store.dispatch("preloader")
			}
			this.$Progress.finish();
			this.$store.dispatch("scan")
			popup;
		},
		created() {
			this.$Progress.start();
			this.$router.beforeEach((to, from, next) => {
				if (to.meta.progress !== undefined) {
					let meta = to.meta.progress;
					this.$Progress.parseMeta(meta);
				}
				this.$Progress.start();
				next();
			});
			this.$router.afterEach((to, from) => {
				this.$Progress.finish();
			});
		},
		methods: {
		},
		computed: {
		},
		components: {
			'login-component': LoginComponent,
			'reset-component': ResetPasswordComponent,
			'registration-component': RegistrationComponent,
			'sidebar-component': SidebarComponent,
		}
	};
</script>

<style scoped lang="scss">
</style>
