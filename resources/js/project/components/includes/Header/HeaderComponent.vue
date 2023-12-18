<template>
	<!-----------------------------------  Header  --Start--  ----------------------------------->
	<header data-lp class="header w-100">
		<top-block></top-block>
		<bottom-block></bottom-block>
	</header>
	<!-----------------------------------  Header  --End--  ----------------------------------->
</template>

<script>
	import TopBlock from './includes/Top/TopBlock.vue';
	import BottomBlock from './includes/Bottom/BottomBlock.vue';
	export default {
		name: 'HeaderComponent',
		data() {
			return {
			};
		},
		mounted() {
			this.$store.dispatch("getCategories");
		},
		updated() {
		},
		beforeDestroy() {
		},
		methods: {
		},
		components: {
			'top-block': TopBlock,
			'bottom-block': BottomBlock,
		},

	}
</script>

<style scoped>
</style>