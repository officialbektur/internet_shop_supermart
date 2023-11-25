<template>
	<section v-if="products && products.length > 0" class="moreinfo-tovar__dp">
		<router-link :to="{ name: 'histories' }" class="_title">
			Вы недавно смотрели
		</router-link>
		<swiper
			:modules="modules"
			:slides-per-view="'auto'"
			:space-between="0"
			:speed="400"
			:freeMode="true"
			:navigation="{ nextEl: '.product-block-slids-pagination__prev', prevEl: '.product-block-slids-pagination__next' }"
			class="product-block-slids">
			<template v-slot:wrapper-start>
				<div v-for="(product, index) in products.slice(0, 12)" :key="index" class="swiper-slide">
					<product-block	product-block :product="product"></product-block>
				</div>
				<div v-if="products.length >= 12" class="product-block-slids__dpinnerlink swiper-slide">
					<router-link :to="{ name: 'index' }" class="product-block-slids__dplink product-block-slids-dplink">
						<span class="product-block-slids-dplink__title">Ещё</span>
						<span class="product-block-slids-dplink__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H109.3l105.3-105.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
						</span>
					</router-link>
				</div>
			</template>
			<template v-slot:container-end>
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
			</template>
		</swiper>
	</section>
</template>

<script>
	import { Navigation } from 'swiper/modules';
	import { Swiper } from 'swiper/vue';

	import ProductBlock from "./ProductBlock.vue";

	export default {
		name: 'HistoriesBlock',
		props: {
			status: Boolean
		},
		components: {
			'product-block': ProductBlock,
			'swiper': Swiper,
		},
		setup() {
			return {
				modules: [Navigation],
			};
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
					if (newStatus === true) {
						this.$store.dispatch('scanLocalStorageHistory');
						this.$store.dispatch('getIds', 'history');
						this.getHistories();
					}
				},
				immediate: true,
			},
		},
		methods: {
			async getHistories() {
				try {
					let response = await axios.post('/api/products/histories', {
						productIds: this.$store.getters.ids.splice(-12)
					});
					if (response && response.data && response.data.data && response.data.data.length > 0) {
						this.products = response.data.data;
					} else {
					}
				} catch (error) {
				}
			},
		},
		computed: {
		},
	}
</script>
<style scoped lang="scss">
</style>