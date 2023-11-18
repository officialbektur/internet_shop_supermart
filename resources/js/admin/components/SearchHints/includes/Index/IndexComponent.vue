<template>
	<tr
		class="block-table__tr">
		<td class="block-table__td block-table__tdcode">
			{{ searchhint.id }}
		</td>
		<td class="block-table__td block-table__tdtitle block-table-tdtitle">
			<div class="block-list__name block-list__title">
				{{ searchhint.name }}
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
							@click.prevent="deleteSearchhint(searchhint.id, index)"
							:id="'delete_' + index"
							:checked="searchhint.status == 1"
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
		<td class="block-table__td block-table__tdedit">
			<router-link :to="{ name: 'searchhints.update', params: { id: searchhint.id ?? 0 } }" class="block-table__edit block-table-edit">
				<div class="block-table-edit__button block-table-edit-button a-hover-bgc">
					<span class="block-table-edit-button__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
					</span>
				</div>
			</router-link>
		</td>
	</tr>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'IndexComponent',
		props: {
			index: Number,
			searchhint: Object
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
			async deleteSearchhint(id, index) {
				this.isReadOnly = true;
				this.isSending = true;

				try {
					const response = await API.delete(`/api/admin/searchhints/${id}`);
					if (response && response.data && typeof response.data.status == 'number') {
						this.$parent.searchhints[index].status = response.data.status;
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