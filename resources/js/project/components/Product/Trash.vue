<template>
	<section class="content index">
		<div class="content__container">
			<div class="content__header content-header">
				<h2 class="content-header__title _title mx-body">
					Корзина
				</h2>
				<div class="content-header__info content-header-info">
					<div class="content-header-info__title">
						Итого:
					</div>
					<div class="content-header-info__content">
						<span class="content-header-info__col content-header-info-col"><span class="content-header-info-col__number">{{ getColTovars }}</span><span class="content-header-info-col__text">шт</span></span>
						/
						<span class="content-header-info__price content-header-info-price"><span class="content-header-info-price__number">{{ getSummaTovars }}</span><span class="content-header-info-price__text">сом</span></span>
					</div>
				</div>
			</div>
			<table class="product-block__trash product-block-trash">
				<thead class="product-block-trash__header product-block-trash-header">
					<tr>
						<th class="product-block-trash-header__list product-block-trash-header__title">
							Название
						</th>
						<th class="product-block-trash-header__list product-block-trash-header__delete">
							Удалить
						</th>
						<th class="product-block-trash-header__list product-block-trash-header__quantity">
							Количество
						</th>
						<th class="product-block-trash-header__list product-block-trash-header__price">
							Сумма
						</th>
					</tr>
				</thead>
				<tbody class="product-block-trash__body">
					<tr v-if="$store.getters.isMessage" class="product-block-trash__block">
						<td colspan="4" class="product-block-trash__nolist">{{ $store.getters.message }}</td>
					</tr>
					<product-trash></product-trash>
				</tbody>
			</table>
			<loading-block></loading-block>
		</div>
	</section>
</template>

<script>
	import ProductTrash from "./../includes/Block/ProductTrash.vue";
	import LoadingBlock from "./../includes/Block/LoadingBlock.vue";

	export default {
		name: 'Trash',
		data(){
			return {
			}
		},
		mounted() {
			this.$store.dispatch('metaInfo', {
				title: 'Корзина',
				description: 'Корзина, сохранненые товары'
			});
			this.$store.dispatch('zeroingProducts');
			this.$store.dispatch('getIds', 'trash');
			this.$store.commit('setMethods', 'post');
			this.$store.commit('setApiSrc', 'products/trash');
			this.$store.commit('setMessage', 'В вашей корзине пока нет сохраненных товаров!');
			this.$store.dispatch('initializeProducts');
		},
		methods: {
			findProductById(products, productId) {
				return products.find(product => product.id === productId);
			},
		},
		updated() {
			this.$store.dispatch('update');
		},
		computed: {
			products() {
				return this.$store.getters.products;
			},
			getColTovars() {
				let products = this.$store.getters.saveTovarTrash;

				let col = 0;
				products.forEach(element => {
					col += element.col ?? 0;
				});
				return col;
			},
			getSummaTovars() {
				let products = this.$store.getters.products;
				let getSaveTovarTrash = this.$store.getters.saveTovarTrash;

				let summa = 0;
				products.forEach(product => {
					let productCol = this.findProductById(getSaveTovarTrash, product.id);
					summa += productCol ? (product.price_now * productCol.col) : 0;
				});
				return summa;
			},
		},
		components: {
			'loading-block': LoadingBlock,
			'product-trash': ProductTrash,
		}
	}
</script>