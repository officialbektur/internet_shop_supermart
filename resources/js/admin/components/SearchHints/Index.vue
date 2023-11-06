<template>
	<div class="block">
		<div class="block__title">Рекомендаций в поиске</div>
		<ul class="block__content">
			<li v-if="searchhints.length > 0" v-for="searchhint in searchhints" :searchhint="searchhint" :key="searchhint" class="block-list">
				<div class="block-list__name block-list__title">
					{{ searchhint.name }}
				</div>
			</li>
		</ul>
	</div>
</template>

<script>
	import * as flsFunctions from "@/admin/files/functions.js";
	export default {
		name: 'Index',
		data() {
			return {
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.dispatch("zeroingSearchHint")
			this.$store.dispatch("getSearchHints")
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
			searchhints() {
				return this.$store.getters.searchhints
			}
		},
		components: {
		}
    }
</script>