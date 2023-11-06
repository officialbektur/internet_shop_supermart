<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Акция
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import ContentBlock from "./../includes/Block/ContentBlock.vue";
	export default {
		name: 'Discount',
		data(){
			return {
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Акция',
				description: 'Товары с акциями'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.commit('setMethods', 'get');
			this.$store.commit('setApiSrc', 'products/discounts');
			this.$store.commit('setMessage', 'Товаров пока нет');
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