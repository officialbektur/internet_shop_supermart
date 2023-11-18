<template>
	<tr v-if="products && products.length > 0" v-for="(product, index) in products" :key="index" class="product-block-trash__block">
		<td class="product-block-trash__column product-block-trash__columntitle">
			<router-link :to="{ name: 'show', params: {id: product.id} }" class="product-block-trash__title product-block-trash-title">
				<div class="product-block-trash-title__image product-block-trash-title-image">
					<div class="product-block-trash-title-image__img">
						<VueLazyload :dataSrc="product.image" :src="'/storage/project/loading.gif'" :alt="`${product.title}_${product.id}`"></VueLazyload>
					</div>
				</div>
				<div class="product-block-trash-title__infotext product-block-trash-titleinfotext">
					<!-- <div class="product-block-trash-title-infotext__category">
						Категория<template v-for="category in Array.isArray(product.categories) ? product.categories : []"> > {{ category.name }}</template>
					</div> -->
					<div class="product-block-trash-title-infotext__category">
						Категория
						<template v-if="Array.isArray(product.categories)">
							<template v-for="category in product.categories">
								> {{ category.name }}
							</template>
						</template>
					</div>
					<div class="product-block-trash-title-infotext__title">
						{{ product.title }}
					</div>
					<div class="product-block-trash-title-infotext__price product-block-trash-title-infotext-price">
						<span class="product-block-trash-title-infotext-price__number">{{ product.price_now }}</span><span class="product-block-trash-title-infotext-price__text">сом</span>
					</div>
				</div>
			</router-link>
		</td>
		<td class="product-block-trash__column product-block-trash__columndelete">
			<div class="product-block-trash__delete product-block-trash-delete">
				<button type="button" @click="deleteProduct(index)" class="product-block-trash-delete__button product-block-trash-delete-button a-hover-bgc">
					<span class="product-block-trash-delete-button__icon">
						<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64s14.3 32 32 32h384c17.7 0 32-14.3 32-32s-14.3-32-32-32h-96l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32l21.2 339c1.6 25.3 22.6 45 47.9 45h245.8c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
					</span>
				</button>
			</div>
		</td>
		<td class="product-block-trash__column product-block-trash__columnquantity">
			<div class="product-block-trash__quantity product-block-trash-quantity">
				<div class="quantity">
					<button type="button" class="quantity__button quantity__button_plus" @click="incrementQuantity(product.id)"></button>
					<div class="quantity__input">
						<input autocomplete="off" type="number" :value="getQuantity(product.id)" min="1" @input="valueQuantity(product.id, $event)">
					</div>
					<button type="button" class="quantity__button quantity__button_minus" @click="decrementQuantity(product.id)"></button>
				</div>
			</div>
		</td>
		<td class="product-block-trash__column product-block-trash__columnprice product-block-trash-price">
			<div class="product-block-trash__price product-block-trash-price">
				<div class="product-block-trash-price__content">
					<span class="product-block-trash-price__number">{{ price(product.id, product.price_now) }}</span><span class="product-block-trash-price__text">сом</span>
				</div>
			</div>
		</td>
	</tr>
</template>

<script>
	import VueLazyload from '@/project/plugins/VueLazyload/VueLazyload.vue';
	export default {
		name: 'ProductTrash',
		props: {
			products: Object
		},
		data(){
			return {
			}
		},
		mounted() {
		},
		methods: {
			deleteProduct(index) {
				let products = this.$store.getters.products;
				products.splice(index, 1);
				if (products.length == 0) {
					this.$store.commit('setIsMessage', true);
				}
				this.$store.dispatch("updateSaveTovarTrash", products);
			},
			price(id, price) {
				let col = this.getQuantity(id);
				return col ? (price * col) : 0;
			},
			incrementQuantity(productId) {
				let currentQuantity = this.getQuantity(productId);
				currentQuantity = currentQuantity >= 0 ? (currentQuantity + 1) : 0;
				this.updateQuantity(productId, currentQuantity);
			},
			decrementQuantity(productId) {
				let currentQuantity = this.getQuantity(productId);
				currentQuantity = currentQuantity >= 1 ? (currentQuantity - 1) : 0;
				this.updateQuantity(productId, currentQuantity);
			},
			getQuantity(productId) {
				const product = this.findProductById(productId);
				return product ? product.col : 1;
			},
			valueQuantity(productId, newQuantity) {
				this.updateQuantity(productId, Number(newQuantity.target.value));
			},
			updateQuantity(productId, newQuantity) {
				this.$store.commit("setAddSaveTovarTrashMethodCol", newQuantity)
				this.$store.dispatch('addSaveTovarTrashAdd', productId)
			},
			findProductById(productId) {
				return this.$store.getters.saveTovarTrash.find(product => product.id === productId);
			},
		},
		computed: {
		},
		components: {
			'VueLazyload': VueLazyload
		}
    }
</script>