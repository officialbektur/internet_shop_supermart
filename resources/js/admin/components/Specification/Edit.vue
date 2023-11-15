<template>
	<div class="block">
		<div class="block__title">Редактирование характеристик</div>
		<ul v-if="isSpecifications" class="block__content">
			<specifications v-if="specifications.length > 0" v-for="specification in specifications" :specification="specification" :key="specification"></specifications>
			<div class="more__loading more-loading" :class="{ '_show': lazyLoading && isSpecifications }">
				<div class="more-loading__content">
					<div class="more-loading__icon">
						<img src="/storage/project/loading.gif" alt="loading">
					</div>
				</div>
			</div>
		</ul>
		<div v-else class="block__title text-center">
			<span class="_error">Нету данных!</span>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	import * as flsFunctions from "@/admin/files/functions.js";
	import Specifications from "./includes/Edit/Specifications.vue";
	export default {
		name: 'Edit',
		data() {
			return {
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.commit("setLazyLoading", true)
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
			},
			lazyLoading() {
				return this.$store.getters.lazyLoading
			},
			isSpecifications() {
				return this.$store.getters.isSpecifications
			}
		},
		components: {
			'specifications': Specifications
		}
    }
</script>