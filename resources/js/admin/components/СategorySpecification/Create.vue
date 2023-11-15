<template>
	<div class="block">
		<div class="block__title">Создать связь с категорием</div>
		<ul v-if="isСategorySpecifications" class="block__content">
			<categories v-if="categories.length > 0" v-for="category in categories" :category="category" :key="category"></categories>
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
	import * as flsFunctions from "@/admin/files/functions.js";
	import Categories from "./includes/Create/Categories.vue";
	export default {
		name: 'Index',
		data() {
			return {
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.dispatch("zeroingCategory")
			this.$store.dispatch("getCategories")
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
			categories() {
				return this.$store.getters.categories
			},
			lazyLoading() {
				return this.$store.getters.lazyLoading
			},
			isСategorySpecifications() {
				return this.$store.getters.isСategorySpecifications
			}
		},
		components: {
			'categories': Categories
		}
    }
</script>