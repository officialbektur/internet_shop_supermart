<template>
	<div class="block">
		<div class="block__title">Теги</div>
		<div class="block__content">
			<table class="block__table block-table">
				<thead class="block-table__header block-table-header">
					<tr>
						<th class="block-table-header__list block-table-header__code">
							#
						</th>
						<th class="block-table-header__list block-table-header__title">
							Название
						</th>
						<th class="block-table-header__list block-table-header__delete">
							Статус
						</th>
						<th class="block-table-header__list block-table-header__edit">
							Изменить
						</th>
					</tr>
				</thead>
				<tbody class="block-table__body">
					<tr
						v-if="!isTags"
						class="block-table__tr">
						<td colspan="3" class="block-table__notd">Нету данных!</td>
					</tr>
					<tag-component v-if="tags.length > 0 && isTags" v-for="(tag, index) in tags" :key="index" :tag="tag" :index="index"></tag-component>
				</tbody>
			</table>
			<div class="more__loading more-loading" :class="{ '_show': lazyLoading && isTags }">
				<div class="more-loading__content">
					<div class="more-loading__icon">
						<img src="/storage/project/loading.gif" alt="loading">
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';

	import TagComponent from './includes/TagComponent.vue';

	import * as flsFunctions from "@/admin/files/functions.js";
	export default {
		name: 'Index',
		data() {
			return {
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.commit("setLazyLoading", true)
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
			},
			lazyLoading() {
				return this.$store.getters.lazyLoading
			},
			isTags() {
				return this.$store.getters.isTags
			}
		},
		components: {
			"tag-component": TagComponent
		}
    }
</script>