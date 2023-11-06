<template>
	<div class="block">
		<div class="block__title">Теги</div>
		<ul class="block__content">
			<li v-if="tags.length > 0" v-for="tag in tags" :tag="tag" :key="tag" class="block-list">
				<div class="block-list__name block-list__title">
					{{ tag.name }}
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
			this.$store.dispatch("zeroingTag")
			this.$store.dispatch("getTags")
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
			tags() {
				return this.$store.getters.tags
			}
		},
		components: {
		}
    }
</script>