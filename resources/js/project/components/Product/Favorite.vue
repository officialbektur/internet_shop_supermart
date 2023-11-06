<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Избранные товары
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import ContentBlock from "./../includes/Block/ContentBlock.vue";
	export default {
		name: 'Favorite',
		data(){
			return {
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Избранные',
				description: 'Сохраненные ваши товары'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.dispatch('getIds', 'favorite');
			this.$store.commit('setMethods', 'post');
			this.$store.commit('setApiSrc', 'products/favorites');
			this.$store.commit('setMessage', 'В вашей избранной пока нет сохраненных товаров!');
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