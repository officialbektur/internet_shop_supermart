<template>
	<h2 class="_title">Настройки</h2>

	<div class="page__content">
		<email-component></email-component>
		<password-component></password-component>
	</div>
</template>

<script>
	import Password from './components/Password.vue';
	import Email from './components/Email.vue';

    export default {
		name: 'SettingComponent',
		data() {
			return {

			}
		},

		methods: {

		},
		computed: {

		},
		components: {
			'email-component': Email,
			'password-component': Password,
		}
    }
</script>