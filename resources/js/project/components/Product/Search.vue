<template>
	<sidebar-component></sidebar-component>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body">
				Поиск <template v-if="total">: "{{ total }}" товаров</template>
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import SidebarComponent from "./../includes/Sidebar/SidebarComponent.vue";
	import ContentBlock from "./../includes/Block/ContentBlock.vue";
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
			total() {
				return this.$store.getters.total
			}
		},
		components: {
			'sidebar-component': SidebarComponent,
			'content-block': ContentBlock,
		}
	}
</script>