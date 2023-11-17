<template>
	<tr
		class="block-table__tr">
		<td class="block-table__td block-table__tdcode">
			{{ commentary.id }}
		</td>
		<td class="block-table__td block-table__tdinfo block-table-tdinfo">
			<div class="block-table-tdtitle__menu">
				<router-link :to="{ name: 'tovars.index', query: { q: commentary.product_id, sort: 1 } }" class="block-table-tdtitle__sticker block-table-tdtitle__title a-hover-bgc">Посмотреть продукт {{ commentary.product_id }}</router-link>
			</div>
			<div class="block-table-tdinfo__content">
				<div class="block-table-tdinfo__avatar">
					{{ commentary.name[0] }}
				</div>
				<div class="block-table-tdinfo__infotext">
					<div class="block-table-tdinfo__name">{{ commentary.name }}</div>
					<div class="block-table-tdinfo__ratinganddate">
						<div class="block-table-tdinfo__rating block-table-tdinfo-rating">
							<span v-for="index in 5" :key="index" class="block-table-tdinfo-rating__icon" :class="{ '_active': index <= commentary.rating }"></span>
						</div>
						<div class="block-table-tdinfo__data">{{ commentary.data }}</div>
					</div>
				</div>
			</div>
			<div class="block-table-tdinfo__message">
				{{ commentary.message }}
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
							@click="deleteCommentary(commentary.id, index)"
							:id="'delete_' + index"
							:checked="commentary.status == 1"
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
			commentary: Object
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
			async deleteCommentary(id, index) {
				this.isReadOnly = true;
				this.isSending = true;

				try {
					const response = await API.delete(`/api/admin/commentaries/${id}`);
					if (response && response.data && typeof response.data.status == 'number') {
						this.$parent.commentaries[index].status = response.data.status;
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