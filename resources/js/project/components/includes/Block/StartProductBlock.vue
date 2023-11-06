<template>
	<div v-for="index in colstartblockproducts" :key="index" class="product__block product-block _show-loading">
		<div class="product-block__image product-block-image">
			<div class="product-block-image__content"></div>
		</div>
		<div class="product-block__info product-block-info">
			<div class="product-block-info__catigory"></div>
			<div class="product-block-info__title"></div>
		</div>
	</div>
</template>

<script>
    export default {
		name: 'StartProductBlock',
		data(){
			return {
			}
		},
		methods: {
		},
		computed: {
			colstartblockproducts() {
				return this.$store.getters.colstartblockproducts;
			}
		},
		components: {
		}
    }
</script>