<template>
	<div class="block-form__item">
		<div class="block__header df jcsb">
			<div class="block__title">
				Адрес № {{ index }}
			</div>
			<button
				:disabled="isReadOnly"
				@click.prevent="deleteEmail(email.id)"
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
					:for="`email_${index}`"
					class="mrb-admin-form__label"
					:class="{ '_error': isEmail }">
					Адрес {{ index }}*:
					<template v-if="isEmail">
						<span v-for="message in email_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="email.email"
						:id="`email_${index}`"
						:name="`email_${index}`"
						:readonly="isReadOnly"
						placeholder="Адрес..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					:for="`email_href_${index}`"
					class="mrb-admin-form__label"
					:class="{ '_error': isEmailHref }">
					Ссылка на адрес {{ index }}*:
					<template v-if="isEmailHref">
						<span v-for="message in email_href_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="email.href"
						:id="`email_href_${index}`"
						:name="`email_href_${index}`"
						:readonly="isReadOnly"
						placeholder="Ссылка на адрес..."
					></textarea>
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
	name: 'EmailBlock',
	props: {
		index: Number,
		email: Object,
	},
	data() {
		return {
			isDelete: false,

			isEmail: false,
			email_valid_message: [],

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
	methods: {
		updateEmail() {
			API.patch(`/api/admin/app/emails`, {
				id: this.email.id,
				email: this.email.email,
				href: this.email.href,
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
		sendEmail() {
			this.isReadOnly = true
			this.loading = true

			this.isEmail = false
			this.email_valid_message = []

			this.isEmailHref = false
			this.email_href_valid_message = []

			if (this.email.email.length === 0) {
				this.isEmail =  true
				this.email_valid_message.push('Заполните обязательное поле!')
			} else if (this.email.email.length > 255) {
				this.isEmail = true
				this.email_valid_message.push('Название вашего emaila должно cодержать менее 255 символов!')
			}

			if (this.email.href.length == 0) {
				this.isEmailHref =  true
				this.email_href_valid_message.push('Заполните обязательное поле!')
			} else if (this.validEmail(this.email.href)) {
				this.isEmailHref =  true
				this.email_href_valid_message.push('Неправильный E-mail!')
			}
			if (!this.isEmail && !this.isEmailHref) {
				this.updateEmail()
			} else {
				this.finishResult('Ошибка валидации', true);
			}
		},
		deleteEmail(id) {
			if (!this.isDelete) {
				this.isDelete = true;
				setTimeout(() => {
					this.isDelete = false;
				}, 2600);
			} else {
				let emails = this.$parent.emails;
				const indexToRemove = emails.findIndex(item => item.id === id);

				if (indexToRemove !== -1) {
					this.$parent.emails.splice(indexToRemove, 1);
					API.delete(`/api/admin/app/emails/${id}`)
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