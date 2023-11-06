<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Новый товары
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import ContentBlock from "./../includes/Block/ContentBlock.vue";
	export default {
		name: 'Nowproduct',
		data(){
			return {
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Новые продукты',
				description: 'Новые прордукты на нашем сайте'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.commit('setMethods', 'get');
			this.$store.commit('setApiSrc', 'products/newproducts');
			this.$store.commit('setMessage', 'Новых товаров пока нет!');
			this.$store.dispatch('initializeProducts');
		},
		methods: {
		},
		updated() {
		},
		computed: {
		},
		components: {
			'content-block': ContentBlock,
		}
	}
</script>