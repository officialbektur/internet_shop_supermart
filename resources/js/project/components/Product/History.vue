<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Не давно смотрели
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
				title: 'История просмотров',
				description: 'История просмотренных товаров'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.dispatch('scanLocalStorageHistory');
			this.$store.dispatch('getIds', 'history');
			this.$store.commit('setMethods', 'post');
			this.$store.commit('setApiSrc', 'products/histories');
			this.$store.commit('setMessage', 'Вы еще не смотрели!');
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