<template>
	<section v-if="products && products.length > 0" class="moreinfo-tovar__history">
		<router-link :to="{ name: 'index' }" class="_title">
			Рекомендуем также
		</router-link>
		<div class="product-block-slids">
			<div class="swiper-wrapper">
				<div v-for="(product, index) in products.slice(0, 12)" :key="index" class="swiper-slide">
					<product-block	product-block :product="product" :index="index"></product-block>
				</div>
				<div class="product-block-slids__historyinnerlink swiper-slide">
					<router-link :to="{ name: 'index' }" class="product-block-slids__historylink product-block-slids-historylink">
						<span class="product-block-slids-historylink__title">Ещё</span>
						<span class="product-block-slids-historylink__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H109.3l105.3-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
						</span>
					</router-link>
				</div>
			</div>
			<a href class="product-block-slids-pagination__next product-block-slids-pagination-next">
				<span class="product-block-slids-pagination-next__icon">
					<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H109.3l105.3-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
				</span>
			</a>
			<a href class="product-block-slids-pagination__prev product-block-slids-pagination-prev">
				<span class="product-block-slids-pagination-prev__icon">
					<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H109.3l105.3-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
				</span>
			</a>
		</div>
	</section>
</template>

<script>
	import { initSliders } from "@/project/files/sliders.js";
	import ProductBlock from "./ProductBlock.vue";
	export default {
		name: 'RecBlock',
		props: {
			status: Boolean,
			id: Number,
		},
		data() {
			return {
				products: [],
			};
		},
		mounted() {
		},
		watch: {
			status: {
				handler(newStatus, oldStatus) {
					if (newStatus === true && this.id) {
						this.getRec();
					}
				},
				immediate: true,
			},
		},
		updated() {
			initSliders();
			this.$store.dispatch('update');
		},
		methods: {
			async getRec() {
				try {
					let response = await axios.get(`/api/categories/${this.id}/recomendations`);
					if (response && response.data && response.data.length > 0) {
						this.products = response.data;
					} else {
					}
				} catch (error) {
				}
			},
		},
		computed: {
		},
		components: {
			'product-block': ProductBlock,
		},
	}
</script>
<style scoped lang="scss">
</style>