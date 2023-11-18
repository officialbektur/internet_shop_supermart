<template>
	<div class="block">
		<div class="block__title">Рекомендаций в поиске</div>
		<ul class="block__content">
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
						v-if="!lazyLoading && notSearchhints"
						class="block-table__tr">
						<td colspan="4" class="block-table__notd">Нету товаров!</td>
					</tr>
					<searchhint-component
						v-if="searchhints.length > 0 && !notSearchhints"
						v-for="(searchhint, index) in searchhints"
						:index="index"
						:searchhint="searchhint"
						:key="index"></searchhint-component>
				</tbody>
			</table>
			<div class="more__loading more-loading" :class="{ '_show': lazyLoading && !notSearchhints }">
				<div class="more-loading__content">
					<div class="more-loading__icon">
						<img src="/storage/project/loading.gif" alt="loading">
					</div>
				</div>
			</div>
		</ul>
	</div>
</template>

<script>
	import API from '@/admin/api';

	import * as flsFunctions from "@/admin/files/functions.js";

	import SearchhintComponent from "./includes/Index/IndexComponent.vue";

	export default {
		name: 'Index',
		data() {
			return {
				searchhints: [],
				lazyLoading: true,
				notSearchhints: false
			}
		},
		mounted() {
			this.$store.dispatch("zeroingSearchHint")
			this.getSearchHints()
		},
		updated() {
		},
		beforeDestroy() {
		},
		methods: {
			async getSearchHints() {
				try {
					let response = await API.get('/api/admin/searchhints');
					if (response && response.data && response.data.length > 0) {
						this.lazyLoading = false
						this.searchhints = response.data
					} else {
						this.lazyLoading = false
						this.notSearchhints = true
					}
				} catch (error) {
					this.lazyLoading = false
					this.notSearchhints = true
				}
			},
		},
		computed: {
		},
		components: {
			'searchhint-component': SearchhintComponent
		}
    }
</script>