<template>
	<section class="content index">
		<div class="content__container">
			<h2 class="_title mx-body title-categories">
				<span class="title-categories__list">Категорий</span>
				<span v-for="(category, index) in categories" :key="index" class="title-categories__list">
					<span class="title-categories__icon">></span>
					<template v-if="categories.length <= (index + 1)">
						<span class="title-categories__link">{{ category.name }}</span>
					</template>
					<template v-else>
						<router-link :to="{ name: 'categories', params: {id: category.id} }" class="title-categories__link">{{ category.name }}</router-link>
					</template>
				</span>
			</h2>
			<content-block></content-block>
		</div>
	</section>
</template>

<script>
	import ContentBlock from "./../includes/Block/ContentBlock.vue";
	export default {
		name: 'Category',
		data(){
			return {
				categories: null,
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Категорий',
				description: 'Все товары в этой категорий'
			});
			this.getCategoriesName();
			this.$store.dispatch('zeroingProducts');
			this.$store.commit('setMethods', 'get');
			this.$store.commit('setApiSrc', `categories/${this.$route.params.id}/products`);
			this.$store.commit('setMessage', 'Товаров пока нет!');
			this.$store.dispatch('initializeProducts');
		},
		methods: {
			async getCategoriesName(){
				try {
					let response =  await axios.get(`/api/categories/${this.$route.params.id}/name`);
					if (response && response.data && response.data.length > 0) {
						this.categories = response.data;
					} else {
						this.$store.commit('setIsLoading', false)
					}
				} catch (error) {
					this.$store.commit('setIsMessage', true)
					this.$store.commit('setIsLoading', false)
				}
			}
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