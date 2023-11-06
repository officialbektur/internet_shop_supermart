<template>
	<div class="block">
		<div class="block__title">Изменить связь с категорием</div>
		<ul class="block__content">
			<categories v-if="categories.length > 0" v-for="category in categories" :category="category" :key="category"></categories>
		</ul>
	</div>
</template>

<script>
	import * as flsFunctions from "@/admin/files/functions.js";
	import Categories from "./includes/Edit/Categories.vue";
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
			}
		},
		components: {
			'categories': Categories
		}
    }
</script>