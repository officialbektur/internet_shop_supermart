<template>
	<tr
		class="block-table__tr">
		<td class="block-table__td block-table__tdcode">
			{{ deleteList.id }}
		</td>
		<td class="block-table__td block-table__tdtitle block-table-tdtitle">
			<div class="block-list__name block-list__title">
				{{ deleteList.name }}
			</div>
		</td>
		<td class="block-table__td block-table__tddelete">
			<div class="block-table__delete block-table-delete">
				<div class="mrb-admin-form__chekbox mrb-admin-form-chekbox">
					<div
						class="mrb-admin-form-chekbox__input"
						:class="{ '_sending': isSending }">
						<input
							:disabled="isReadOnly"
							@click.prevent="deletedeleteList(deleteList.id, index)"
							:id="'delete_' + index"
							:checked="deleteList.status == 1"
							type="checkbox"
							name="delete">
						<label :for="'delete_' + index"></label>
						<div class="mrb-admin-form-chekbox__status mrb-admin-form-chekbox-status">
							<div class="mrb-admin-form-chekbox-status__not">Нет</div>
							<div class="mrb-admin-form-chekbox-status__yes">Да</div>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'IndexComponent',
		props: {
			index: Number,
			deleteList: Object
		},
		data() {
			return {
				isReadOnly: false,
				isSending: false,
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			async deletedeleteList(id, index) {
				this.isReadOnly = true;
				this.isSending = true;

				try {
					const response = await API.delete(`/api/admin/specifications/${id}`);
					if (response && response.data && typeof response.data.status == 'number') {
						this.$parent.deleteLists[index].status = response.data.status;
					}
				} catch (error) {
				} finally {
					this.isSending = false;
					setTimeout(() => {
						this.isReadOnly = false;
					}, 400);
				}
			}
		},
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>