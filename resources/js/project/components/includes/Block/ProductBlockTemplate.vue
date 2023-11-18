<template>
	<template v-if="products && products.length > 0" v-for="(product, index) in products" :key="index">
		<product-block :product="product"></product-block>
	</template>
</template>

<script>
	import ProductBlock from "./ProductBlock.vue";
	export default {
		name: 'ProductBlockTemplate',
		data(){
			return {
			}
		},
		mounted() {
		},
		methods: {
		},
		updated() {
		},
		computed: {
			products() {
				return this.$store.getters.products;
			},
		},
		components: {
			'product-block': ProductBlock
		}
    }
</script>