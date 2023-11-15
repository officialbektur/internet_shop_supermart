<template>
	<div class="block-form__item">
		<div class="block__title">Создать новый адресс</div>
		<form method="post" class="mrb-admin__form mrb-admin-form">
			<div class="mrb-admin-form__item">
				<label
					for="email"
					class="mrb-admin-form__label"
					:class="{ '_error': isEmail }">
					Email*:
					<template v-if="isEmail">
						<span v-for="message in email_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<input
						type="text"
						v-model="email"
						id="email"
						name="email"
						:readonly="isReadOnly"
						placeholder="Введите email">
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="email_href"
					class="mrb-admin-form__label"
					:class="{ '_error': isEmailHref }">
					Ссылку на email*:
					<template v-if="isEmailHref">
						<span v-for="message in email_href_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<input
						type="email"
						v-model="email_href"
						id="email_href"
						name="email_href"
						:readonly="isReadOnly"
						placeholder="Введите email">
				</div>
			</div>
			<div class="mrb-admin-form__innerbutton">
				<button
					type="submit"
					@click.prevent="sendEmail"
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
		name: 'AddEmail',
		data() {
			return {
				email: '',
				isEmail: false,
				email_valid_message: [],

				email_href: '',
				isEmailHref: false,
				email_href_valid_message: [],

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
			storeEmail() {
				const data = {
					map: this.map,
					email: this.email,
					href: this.email_href
				};
				API.post(`/api/admin/app/emails`, data)
				.then( response => {
					if (response && response.data) {
						if (response.data.message && response.data.id) {
							this.finishResult(response.data.message);
							let getEmails = this.$parent.emails;
							getEmails.push({
								id: response.data.id,
								map: this.map,
								email: this.email,
								href: this.email_href
							})
							this.$parent.emails = getEmails;

							this.map = ''
							this.email = ''
							this.email_href = ''

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
			sendEmail() {
				this.isReadOnly = true
				this.loading = true

				this.isEmail = false
				this.email_valid_message = []

				this.isEmailHref = false
				this.email_href_valid_message = []

				if (this.email.length === 0) {
					this.isEmail =  true
					this.email_valid_message.push('Заполните обязательное поле!')
				} else if (this.email.length > 255) {
					this.isEmail = true
					this.email_valid_message.push('Название вашего emaila должно cодержать менее 255 символов!')
				}

				if (this.email_href.length == 0) {
					this.isEmailHref =  true
					this.email_href_valid_message.push('Заполните обязательное поле!')
				} else if (this.validEmail(this.email_href)) {
					this.isEmailHref =  true
					this.email_href_valid_message.push('Неправильный E-mail!')
				}
				if (!this.isEmail && !this.isEmailHref) {
					this.storeEmail()
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
			validEmail(email) {
				return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(email);
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