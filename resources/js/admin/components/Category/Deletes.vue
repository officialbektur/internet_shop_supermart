<template>
	<div class="block">
		<div class="block__title">Данные</div>
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
						v-if="notDeleteLists"
						class="block-table__tr">
						<td colspan="4" class="block-table__notd">Нету данных!</td>
					</tr>
					<deleteList-component
						v-if="deleteLists.length > 0 && !notDeleteLists"
						v-for="(deleteList, index) in deleteLists"
						:index="index"
						:deleteList="deleteList"
						:key="index"></deleteList-component>
				</tbody>
			</table>
		</ul>
	</div>
</template>

<script>
	import API from '@/admin/api';

	import DeletesComponent from "../Category/includes/Deletes/IndexComponent.vue";

	export default {
		name: 'Deletes',
		data() {
			return {
				deleteLists: [],
				notDeleteLists: false
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
					let response = await API.get('/api/admin/categories/deletes');
					if (response && response.data && response.data.length > 0) {
						this.delete_lists = response.data
					}
				} catch (error) {
				}
			},
		},
		computed: {
		},
		components: {
			'deletes-component': DeletesComponent
		}
    }
</script>