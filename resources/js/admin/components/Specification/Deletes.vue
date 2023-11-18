<template>
	<div class="block">
		<div class="block__title">Удаленные характеристики</div>
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
					</tr>
				</thead>
				<tbody class="block-table__body">
					<tr
						v-if="!lazyLoading && notDeleteLists"
						class="block-table__tr">
						<td colspan="4" class="block-table__notd">Нету данных!</td>
					</tr>
					<delete-component
						v-if="deleteLists.length > 0 && !notDeleteLists"
						v-for="(deleteList, index) in deleteLists"
						:index="index"
						:deleteList="deleteList"
						:key="index"></delete-component>
				</tbody>
			</table>
			<div class="more__loading more-loading" :class="{ '_show': lazyLoading && !notDeleteLists }">
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

	import DeleteComponent from "./includes/Delete/IndexComponent.vue";

	export default {
		name: 'Deletes',
		data() {
			return {
				deleteLists: [],
				lazyLoading: true,
				notDeleteLists: false,
			}
		},
		mounted() {
			this.getDeletes()
		},
		updated() {
		},
		beforeDestroy() {
		},
		methods: {
			async getDeletes() {
				try {
					let response = await API.get('/api/admin/specifications/deletes');
					if (response && response.data && response.data.length > 0) {
						this.lazyLoading = false
						this.deleteLists = response.data
					} else {
						this.lazyLoading = false
						this.notDeleteLists = true
					}
				} catch (error) {
					this.lazyLoading = false
					this.notDeleteLists = true
				}
			},
		},
		computed: {
		},
		components: {
			'delete-component': DeleteComponent
		}
    }
</script>