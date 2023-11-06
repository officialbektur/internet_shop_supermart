<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Поиск
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import ContentBlock from "../includes/Block/ContentBlock.vue";
	export default {
		name: 'Index',
		data(){
			return {
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Поиск',
				description: 'Поиск товаров на сайте'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.dispatch('getSearchHref', this.$route.query)
			this.$store.commit('setMethods', 'get');
			this.$store.commit('setApiSrc', 'search'+this.$store.getters.searchHref);
			this.$store.commit('setMessage', 'Товаров пока нет!');
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