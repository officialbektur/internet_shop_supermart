<template>
	<div v-if="!isMessage" class="content__body">
		<start-product-block v-if="products == 0"></start-product-block>
		<product-block-template></product-block-template>
	</div>
	<message-block v-if="isMessage" class="mx-body"></message-block>
	<loading-block v-if="!isMessage"></loading-block>
</template>

<script>
	import StartProductBlock from "./StartProductBlock.vue";
	import ProductBlockTemplate from "./ProductBlockTemplate.vue";
	import LoadingBlock from "./LoadingBlock.vue";
	import MessageBlock from "./MessageBlock.vue";
	export default {
		name: 'ContentBlock',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
		},
		computed: {
			products() {
				return this.$store.getters.products.length;
			},
			isMessage() {
				return this.$store.getters.isMessage;
			}
		},
		components: {
			'start-product-block': StartProductBlock,
			'product-block-template': ProductBlockTemplate,
			'message-block': MessageBlock,
			'loading-block': LoadingBlock,
		},
    }
</script>

<style scoped>
</style>