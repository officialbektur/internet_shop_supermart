<template>
	<div class="block-form__item">
	<div class="block__header df jcsb">
		<div class="block__title">
			Адрес № {{ index }}
		</div>
		<button
			:disabled="isReadOnly"
			@click.prevent="deleteAdress(adress.id)"
			type="button"
			class="mrb-button-delete"
			:class="{ '_active': isDelete }">
				<span class="mrb-button-delete__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>
				</span>
				<div class="mrb-button-delete__agreement">?</div>
		</button>
	</div>
	<form method="post" class="mrb-admin__form mrb-admin-form">
		<div class="mrb-admin-form__item">
		<label
			:for="`map_${index}`"
			class="mrb-admin-form__label"
			:class="{ '_error':isMap }"
		>
			Ссылка на iframe {{ index }}*:
			<template v-if="isMap">
			<span v-for="message in map_valid_message" :key="message">
				{{ message + ' ' }}
			</span>
			</template>
		</label>
		<div class="mrb-admin-form__input">
			<textarea
			v-model="adress.map"
			:id="`map_${index}`"
			:name="`map_${index}`"
			:readonly="isReadOnly"
			placeholder="Ссылка на iframe..."
			></textarea>
		</div>
		</div>
		<div class="mrb-admin-form__item">
		<label
			:for="`title_${index}`"
			class="mrb-admin-form__label"
			:class="{ '_error': isTitle }"
		>
			Адрес {{ index }}*:
			<template v-if="isTitle">
			<span v-for="message in title_valid_message" :key="message">
				{{ message + ' ' }}
			</span>
			</template>
		</label>
		<div class="mrb-admin-form__input">
			<textarea
				v-model="adress.title"
				:id="`title_${index}`"
				:name="`title_${index}`"
				:readonly="isReadOnly"
				placeholder="Адрес..."
			></textarea>
		</div>
		</div>
		<div class="mrb-admin-form__item">
		<label
			:for="`adress_href_${index}`"
			class="mrb-admin-form__label"
			:class="{ '_error': isAdressHref }">
			Ссылка на адрес {{ index }}*:
			<template v-if="isAdressHref">
				<span v-for="message in adress_href_valid_message" :key="message">
					{{ message + ' ' }}
				</span>
			</template>
		</label>
		<div class="mrb-admin-form__input">
			<textarea
				v-model="adress.href"
				:id="`adress_href_${index}`"
				:name="`adress_href_${index}`"
				:readonly="isReadOnly"
				placeholder="Ссылка на адрес..."
			></textarea>
		</div>
		</div>
		<div class="mrb-admin-form__innerbutton">
		<button
			type="submit"
			@click.prevent="sendAdress"
			:disabled="isReadOnly"
			class="block-form__button block-form__submit block-form-submit"
			:class="{
				'_loading': loading,
				'_sending': result,
				'_error': isErrorResult
			}">

			<span class="block-form-submit__title">Изменить</span>
			<span class="block-form-submit__result">{{ resultMessage }}</span>
		</button>
		</div>
	</form>
	</div>
</template>

<script>
import API from '@/admin/api';
export default {
	name: 'AdressBlock',
	props: {
		index: Number,
		adress: Object,
	},
	data() {
		return {
			isDelete: false,

			map: '',
			isMap: false,
			map_valid_message: [],

			isTitle: false,
			title_valid_message: [],

			isAdressHref: false,
			adress_href_valid_message: [],

			isReadOnly: false,
			loading: false,
			result: false,
			isErrorResult: false,
			resultMessage: '',
		};
	},
	mounted() {
	},
	methods: {
		updateAdress() {
			API.patch(`/api/admin/app/adress`, {
				id: this.adress.id,
				map: this.adress.map,
				title: this.adress.title,
				href: this.adress.href,
			})
			.then(response => {
				if (response && response.data) {
					if (response.data.message) {
						this.finishResult(response.data.message);
					} else if (response.data.error) {
						this.finishResult(response.data.error, true);
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				} else {
					this.finishResult('Непредвиденная ошибка', true);
				}
			})
			.catch(error => {
				if (error.response && error.response.data && error.response.data.error) {
					this.finishResult(error.response.data.error, true);
				} else if (error.response && error.response.data && error.response.data.message) {
					this.finishResult(error.response.data.message, true);
				} else {
					this.finishResult('Непредвиденная ошибка', true);
				}
			});
		},
		sendAdress() {
			this.isReadOnly = true;
			this.loading = true;

			this.isMap = false;
			this.map_valid_message = [];

			this.isTitle = false;
			this.title_valid_message = [];

			this.isAdressHref = false;
			this.adress_href_valid_message = [];

			if (this.adress.map.length === 0) {
				let message = this.map_valid_message;
				message.push('Введите iframe!');
				this.isMap = true;
				this.map_valid_message = message;
			}

			if (this.adress.title.length === 0) {
				let message = this.title_valid_message;
				message.push('Введите название вашего местоположения!');
				this.isTitle = true;
				this.title_valid_message = message;
			} else if (this.adress.title.length > 255) {
				let message = this.title_valid_message;
				message.push('Название вашего местоположения должно содержать менее 255 символов!');
				this.isTitle = true;
				this.title_valid_message = message;
			}

			if (this.adress.href.length === 0) {
				let message = this.adress_href_valid_message;
				message.push('Введите ссылку на ваше местоположение!');
				this.isAdressHref = true;
				this.adress_href_valid_message = message;
			}

			if (!this.isMap && !this.isTitle && !this.isAdressHref) {
				this.updateAdress();
			} else {
				this.finishResult('Ошибка валидации', true);
			}
		},
		deleteAdress(id) {
			if (!this.isDelete) {
				this.isDelete = true;
				setTimeout(() => {
					this.isDelete = false;
				}, 2600);
			} else {
				let adresses = this.$parent.adresses;
				const indexToRemove = adresses.findIndex(item => item.id === id);

				if (indexToRemove !== -1) {
					this.$parent.adresses.splice(indexToRemove, 1);
					API.delete(`/api/admin/app/adress/${id}`)
				}

				this.isDelete = false;
			}
		},
		finishResult(message, errorStatus = false) {
			setTimeout(() => {
			this.resultMessage = message;
			this.result = true;
			this.loading = false;
			if (errorStatus) {
				this.isErrorResult = true;
			}
			setTimeout(() => {
				this.result = false;
				if (errorStatus) {
				this.isErrorResult = false;
				}
				setTimeout(() => {
				this.isReadOnly = false;
				}, 600);
			}, 2400);
			}, 600);
		},
	},
};
</script>

<style scoped lang="scss">
</style>