<template>
	<div class="block">
		<div class="block__title">Характеристики</div>
		<ul class="block__content">
			<specifications v-if="specifications.length > 0" v-for="specification in specifications" :specification="specification" :key="specification"></specifications>
		</ul>
	</div>
</template>

<script>
	import * as flsFunctions from "@/admin/files/functions.js";
	import Specification from "./includes/Index/Specifications.vue";
	export default {
		name: 'Index',
		data() {
			return {
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.dispatch("zeroingSpecification")
			this.$store.dispatch("getSpecifications")
			if (!this.clickListenerAdded) {
				this.addClickListener();
				this.clickListenerAdded = true;
			}
		},
		updated() {
		},
		beforeDestroy() {
			this.removeClickListener();
		},
		methods: {
			addClickListener() {
				document.documentElement.addEventListener("click", this.handleWindowClick);
			},
			removeClickListener() {
				document.documentElement.removeEventListener("click", this.handleWindowClick);
			},
			handleWindowClick(e) {
				const el = e.target;
				if (this.isSubMenuIcon(el)) {
					this.toggleSubMenu(el);
				}
			},
			isSubMenuIcon(target) {
				return target.classList.contains('block-sublist__button');
			},
			toggleSubMenu(target) {
				const submenu = target.nextElementSibling;
				const parent = target;
				if (!submenu.classList.contains("_slide")) {
					flsFunctions._slideToggle(submenu);
					parent.classList.toggle('_active');
				}
			},
		},
		computed: {
			specifications() {
				return this.$store.getters.specifications
			}
		},
		components: {
			'specifications': Specification
		}
    }
</script>