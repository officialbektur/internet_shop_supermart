<template>
	<div class="block-form__item">
		<div class="block__title">Создать новый номер</div>
		<form method="post" class="mrb-admin__form mrb-admin-form">
			<div class="mrb-admin-form__item">
				<label
					for="telephone"
					class="mrb-admin-form__label"
					:class="{ '_error': isTelephone }">
					Telephone*:
					<template v-if="isTelephone">
						<span v-for="message in telephone_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<input
						type="text"
						v-model="telephone"
						id="telephone"
						name="telephone"
						:readonly="isReadOnly"
						placeholder="Введите telephone">
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="telephone_href"
					class="mrb-admin-form__label"
					:class="{ '_error': isTelephoneHref }">
					Ссылку на telephone*:
					<template v-if="isTelephoneHref">
						<span v-for="message in telephone_href_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<input
						type="telephone"
						v-model="telephone_href"
						id="telephone_href"
						name="telephone_href"
						:readonly="isReadOnly"
						placeholder="Введите telephone">
				</div>
			</div>
			<div class="mrb-admin-form__innerbutton">
				<button
					type="submit"
					@click.prevent="sendTelephone"
					:disabled="isReadOnly"
					class="block-form__button block-form__submit block-form-submit"
					:class="{
						'_loading': loading,
						'_sending': result,
						'_error':  isErrorResult
					}">

					<span class="block-form-submit__title">Добавить</span>
					<span class="block-form-submit__result">{{ resultMessage }}</span>
				</button>
			</div>
		</form>
	</div>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'AddTelephone',
		data() {
			return {
				telephone: '',
				isTelephone: false,
				telephone_valid_message: [],

				telephone_href: '',
				isTelephoneHref: false,
				telephone_href_valid_message: [],

				isReadOnly: false,

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			storeTelephone() {
				const data = {
					number: this.telephone,
					href: this.telephone_href
				};
				API.post(`/api/admin/app/telephones`, data)
				.then( response => {
					if (response && response.data) {
						if (response.data.message && response.data.id) {
							this.finishResult(response.data.message);
							let getTelephones = this.$parent.telephones;
							getTelephones.push({
								id: response.data.id,
								number: this.telephone,
								href: this.telephone_href
							})
							this.$parent.telephones = getTelephones;

							this.telephone = ''
							this.telephone_href = ''

						} else if (response.data.error) {
							this.finishResult(response.data.error, true);
						} else {
							this.finishResult('Непредвиденная ошибка', true);
						}
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
				.catch( error => {
					if (error.response && error.response.data && error.response.data.error) {
						this.finishResult(error.response.data.error, true);
					} else if (error.response && error.response.data && error.response.data.message) {
						this.finishResult(error.response.data.message, true);
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				});
			},
			sendTelephone() {
				this.isReadOnly = true
				this.loading = true

				this.isTelephone = false
				this.telephone_valid_message = []

				this.isTelephoneHref = false
				this.telephone_href_valid_message = []

				if (this.telephone.length === 0) {
					this.isTelephone =  true
					this.telephone_valid_message.push('Заполните обязательное поле!')
				} else if (this.telephone.length > 255) {
					this.isTelephone = true
					this.telephone_valid_message.push('Название вашего telephonea должно cодержать менее 255 символов!')
				}

				if (this.telephone_href.length === 0) {
					this.isTelephoneHref =  true
					this.telephone_href_valid_message.push('Заполните обязательное поле!')
				} else if (this.telephone_href.length > 255) {
					this.isTelephoneHref = true
					this.telephone_href_valid_message.push('Название вашего telephonea должно cодержать менее 255 символов!')
				}

				if (!this.isTelephone && !this.isTelephoneHref) {
					this.storeTelephone()
				} else {
					this.finishResult('Ошибка валидации', true);
				}
			},
			finishResult(message, errorStatus = false) {
				setTimeout(() => {
					this.resultMessage = message
					this.result = true
					this.loading = false


					if (errorStatus) {
						this.isErrorResult = true
					}
					setTimeout(() => {
						this.result = false
						if (errorStatus) {
							this.isErrorResult = false
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 2400);
				}, 600);
			},
		},
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>