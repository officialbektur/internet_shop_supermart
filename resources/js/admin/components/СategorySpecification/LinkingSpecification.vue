<template>
	<div class="block">
		<div class="block__title">Характеристика связанное с этим категорией</div>
		<ul v-if="isСategorySpecifications" class="block__content">
			<specifications v-if="specifications.length > 0" v-for="specification in specifications" :specification="specification" :key="specification"></specifications>
			<div class="more__loading more-loading" :class="{ '_show': lazyLoading && isСategorySpecifications }">
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
	import Specifications from "./includes/Index/Specifications.vue";
	export default {
		name: 'Index',
		data() {
			return {
				specifications: [],
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.commit("setLazyLoading", true)
			this.$store.dispatch("zeroingSpecification")
			this.getSpecification();
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
			async getSpecification() {
				try {
					let response = await API.get('/api/admin/category_specifications/' + this.$route.params.id);
					if (response && response.data && response.data.length > 0) {
						this.$store.commit("setLazyLoading", false)
						this.specifications = response.data;
					} else {
						this.$store.commit("setLazyLoading", false)
						this.$store.commit("setIsSpecifications", false)
					}
				} catch (error) {
					this.$store.commit("setLazyLoading", false)
					this.$store.commit("setIsSpecifications", false)
				}
			},
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
			lazyLoading() {
				return this.$store.getters.lazyLoading
			},
			isСategorySpecifications() {
				return this.$store.getters.isСategorySpecifications
			}
		},
		components: {
			'specifications': Specifications
		}
    }
</script>