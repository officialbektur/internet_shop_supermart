<template>
	<div class="block">
		<div class="block__header df">
			<div class="block__title">
				Редактирование характеристику:
			</div>
			<button
				:disabled="$store.getters.isReadOnly"
				@click.prevent="$store.dispatch('deleteSpecification', $route.params.id)"
				type="button"
				class="mrb-button-delete"
				:class="{ '_active': $store.getters.isDeleteSpecification }">
				<span class="mrb-button-delete__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>
				</span>
				<div class="mrb-button-delete__agreement">?</div>
			</button>
		</div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					v-if="$store.getters.table == 1"
					class="block-form__item"
					:class="{ '_error': $store.getters.isName }">
					<label for="name" class="block-form__label">
						Название характеристики*:
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
							placeholder="Название характеристики...">
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
						<a href :data-popup="$store.getters.isReadOnly ? $store.getters.isReadOnly : '#specifications__popup'" class="block-form-item__select block-form-item-select" :class="{ '_show': $store.getters.specificationTitle.toString().length > 0 }">
							<div class="block-form-item-select__title">{{ $store.getters.specificationTitle.toString().length > 0 ? $store.getters.specificationTitle : 'Выберите характеристику' }}</div>
							<div class="block-form-item-select__button block-form-item-select-button">
								<div class="block-form-item-select-button__icon">
									<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
								</div>
								<div @click.prevent="$store.dispatch('clearSpecification')" class="block-form-item-select-button__clear a-hover-bgc">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
								</div>
							</div>
						</a>
					</div>
					<specifications-popup></specifications-popup>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						@click.prevent="$store.dispatch('sendSpecification', 'updateSpecification')"
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
	import API from '@/admin/api';
	import SpecificationsPopup from './../Popup/SpecificationPopup.vue';
	export default {
		name: 'Update',
		data() {
			return {
			}
		},
		mounted() {
			this.$store.dispatch("zeroingSpecification")
			this.getSpecification()
		},
		methods: {
			async getSpecification() {
				try {
					let response = await API.get('/api/admin/specifications/' + this.$route.params.id);
					if (response && response.data && response.data.length > 0) {
						this.$store.commit("setSpecification", response.data);
						this.$store.commit("setName", response.data[response.data.length - 1].name)
						if (response.data.length == 1) {
							this.$store.commit("setSpecificationTitle", 'На главном')
							this.$store.commit("setParentId", 0)
						} else {
							this.$store.commit("setSpecificationTitle", response.data[response.data.length - 2].name)
							this.$store.commit("setParentId", response.data[response.data.length - 2].id)
						}
					} else {
						this.$router.push({ name: 'specifications.edit'});
					}
				} catch (error) {
					this.$router.push({ name: 'specifications.edit'});
				}
			},
		},
		computed: {
		},
		components: {
			'specifications-popup': SpecificationsPopup
		}
	}
</script>