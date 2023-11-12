<template>
	<div class="block">
		<div class="block__title">Адрессы</div>
		<div class="block__content block__form block-form">
			<template v-if="adresses.length > 0">
				<adress-block
					v-for="(adress, index) in adresses"
					:key="index"
					:index="++index"
					:adress="adress"></adress-block>
			</template>
			<add-adress></add-adress>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	import AdressBlock from './includes/AdressBlock.vue';
	import AddAdress from './includes/AddAdress.vue';
	export default {
		name: 'IndexComponent',
		data() {
			return {
				adresses: []
			};
		},
		watch: {
			getAdresses(newAdresses, oldAdresses) {
				this.adresses = newAdresses;
			}
		},
		mounted() {
		},
		updated() {
		},
		methods: {
		},
		computed: {
			getAdresses() {
				return this.$parent.app.adresses;
			}
		},
		components: {
			'adress-block': AdressBlock,
			'add-adress': AddAdress,
		},
	}
</script>
<style scoped lang="scss">
</style>