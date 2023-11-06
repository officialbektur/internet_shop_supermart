<template>
	<sidebar-component v-if="accessToken"></sidebar-component>
	<main class="page" :class="{ 'margin-left-sidebar': accessToken , 'df fdc aic': !accessToken}">
		<router-view :key="$route.fullPath"></router-view>
	</main>
</template>

<script>
import API from '@/admin/api';
import SidebarComponent from './includes/SidebarComponent.vue';
import { popup } from '@/Admin/libs/popup.js';
export default {
	name: 'Index',
	data() {
		return {
			accessToken: null
		};
	},
	mounted() {
		this.getAccessToken()
		this.scan();
		popup;
	},
	updated() {
		this.getAccessToken()
	},
	methods: {
		scan() {
			API.post("/api/admin/auth/me")
			.then( res => {
				if (res && res.data && res.data.id) {
					this.accessToken = localStorage.getItem("access_token");
				} else {
					localStorage.removeItem("access_token")
					this.$router.push({ name: 'users.login'})
				}
			})
		},
		getAccessToken() {
			this.accessToken = localStorage.getItem("access_token");
		},
		async logout() {
			try {
				await API.post("/api/admin/auth/logout");
			} finally {
				localStorage.removeItem('access_token');
				this.accessToken = null;
				this.$router.push({ name: 'users.login' });
			}
		}
	},
	components: {
		'sidebar-component': SidebarComponent
	}
};
</script>

<style scoped>
</style>
