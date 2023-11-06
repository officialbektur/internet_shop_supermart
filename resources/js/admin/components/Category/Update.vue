<template>
	<div class="block">
		<div class="block__title">Редактирование категорий: <button @click="$store.dispatch('deleteCategory', $store.getters.category[$store.getters.category.length - 1].id)" type="button" class="_error">( удалить )</button></div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					v-if="$store.getters.table == 1"
					class="block-form__item"
					:class="{ '_error': $store.getters.isName }">
					<label for="name" class="block-form__label">
						Название категории*:
						<template v-if="$store.getters.isName">
							<span v-for="message in $store.getters.name_valid_message" :key="message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.219 350.5C11.38 351.5 13.69 352 16 352c3.688 0 7.312-1.25 10.25-3.719l96-80C125.9 265.3 128 260.7 128 255.1S125.9 246.8 122.3 243.7l-96-80c-4.781-4-11.41-4.781-17.03-2.219C3.594 164.2 0 169.8 0 176v160C0 342.2 3.594 347.8 9.219 350.5zM32 96h384c17.67 0 32-14.33 32-32S433.7 32 416 32H32C14.33 32 0 46.33 0 63.1S14.33 96 32 96zM416 416H32c-17.67 0-32 14.33-32 31.1S14.33 480 32 480h384c17.67 0 32-14.33 32-32S433.7 416 416 416zM416 288h-192C206.3 288 192 302.3 192 319.1S206.3 352 224 352h192c17.67 0 32-14.33 32-32S433.7 288 416 288zM416 160h-192C206.3 160 192 174.3 192 191.1S206.3 224 224 224h192c17.67 0 32-14.33 32-32S433.7 160 416 160z"/></svg>
						</div>
						<input
							type="text"
							@input="$store.dispatch('inputWatchName', $event)"
							:value="$store.getters.name"
							id="name"
							autocomplete="off"
							:readonly="$store.getters.isReadOnly || $store.getters.table !== 1"
							class="block-form-input__input"
							placeholder="Название категории...">
					</div>
				</div>
				<div
					v-if="$store.getters.table == 2"
					class="block-form__item"
					:class="{ '_error': $store.getters.isParentId }">
					<label class="block-form__label">
						Выберите где будет распологаться категория "{{ $store.getters.name.trim() }}"*:
						<template v-if="$store.getters.isParentId">
							<span v-for="message in $store.getters.parent_id_valid_message" :key="message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content">
						<a href :data-popup="$store.getters.isReadOnly ? $store.getters.isReadOnly : '#categories__popup'" class="block-form-item__select block-form-item-select" :class="{ '_show': $store.getters.categoryTitle.toString().length > 0 }">
							<div class="block-form-item-select__title">{{ $store.getters.categoryTitle.toString().length > 0 ? $store.getters.categoryTitle : 'Выберите категорию' }}</div>
							<div class="block-form-item-select__button block-form-item-select-button">
								<div class="block-form-item-select-button__icon">
									<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
								</div>
								<div @click.prevent="$store.dispatch('clearCategory')" class="block-form-item-select-button__clear a-hover-bgc">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
								</div>
							</div>
						</a>
					</div>
					<categories-popup></categories-popup>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						@click.prevent="$store.dispatch('sendCategory', 'updateCategory')"
						:disabled="$store.getters.isReadOnly"
						class="block-form__button block-form__submit block-form-submit"
						:class="{
								'_loading': $store.getters.loading,
								'_sending': $store.getters.result,
								'_error': $store.getters.isErrorResult
							}">
						<span class="block-form-submit__title">Добавить</span>
						<span class="block-form-submit__result">{{ $store.getters.resulMassage }}</span>
					</button>
				</div>
				<div
					v-if="$store.getters.table > 1"
					class="block-form__item">
					<button
						type="button"
						@click.prevent="$store.dispatch('back')"
						:disabled="$store.getters.isReadOnly"
						class="block-form__button block-form__submit block-form-submit _error">
						<span class="block-form-submit__title">Назад</span>
					</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import CategoriesPopup from './../Popup/CategoryPopup.vue';
    export default {
		name: 'Create',
		data() {
			return {
			}
		},
		mounted() {
			this.$store.dispatch("zeroingCategory")
			this.getCategory()
		},
		methods: {
			async getCategory() {
				try {
					let response = await axios.get('/api/categories/' + this.$route.params.id + '/name');
					if (response && response.data && response.data.length > 0) {
						this.$store.commit("setCategory", response.data);
						this.$store.commit("setName", response.data[response.data.length - 1].name)
						if (response.data.length == 1) {
							this.$store.commit("setCategoryTitle", 'На главном')
							this.$store.commit("setParentId", 0)
						} else {
							let title = [];
							response.data.forEach((element, index) => {
								if (response.data.length > index + 1) {
									title.push(element.name.trim());
								}
							});
							const titleString = title.join(' / ');
							this.$store.commit("setCategoryTitle", titleString)
							this.$store.commit("setParentId", response.data[response.data.length - 2].id)
						}
					} else {
						this.$router.push({ name: 'categories.edit'});
					}
				} catch (error) {
					this.$router.push({ name: 'categories.edit'});
				}
			},
		},
		computed: {
		},
		components: {
			'categories-popup': CategoriesPopup
		}
    }
</script>