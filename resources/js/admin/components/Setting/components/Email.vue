<template>
	<div class="block">
		<div class="block__title">Изменить E-Mail</div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					v-if="table == 1"
					class="block-form__item"
					:class="{ '_error': isEmail }">
					<label for="email" class="block-form__label">
						Ваш email*:
						<template v-if="isEmail">
							<span v-for="message in email_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							type="email"
							id="email"
							v-model="email"
							:readonly="isReadOnly || table !== 1"
							autocomplete="off"
							class="block-form-input__input"
							placeholder="Введите email">
					</div>
				</div>
				<div
					v-if="table == 2"
					class="block-form__item"
					:class="{ '_error': isCode }">
					<label for="code" class="block-form__label">
						Код подверждение*:
						<template v-if="isCode">
							<span v-for="message in code_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							type="number"
							id="code"
							v-model="code"
							:readonly="isReadOnly || table !== 2"
							autocomplete="off"
							class="block-form-input__input"
							placeholder="Код подверждение">
					</div>
				</div>
				<div
					v-if="table == 3"
					class="block-form__item"
					:class="{ '_error': isEmailNew }">
					<label for="email_new" class="block-form__label">
						Новый email*:
						<template v-if="isEmailNew">
							<span v-for="message in email_new_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							type="email"
							id="email_new"
							v-model="email_new"
							:readonly="isReadOnly || table !== 3"
							autocomplete="off"
							class="block-form-input__input"
							placeholder="Новый email">
					</div>
				</div>
				<div
					v-if="table == 4"
					class="block-form__item"
					:class="{ '_error': isCodeNew }">
					<label for="code_new" class="block-form__label">
						Код подверждение*:
						<template v-if="isCodeNew">
							<span v-for="message in code_new_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							type="number"
							id="code_new"
							v-model="code_new"
							autocomplete="off"
							:readonly="isReadOnly || table !== 4"
							class="block-form-input__input"
							placeholder="Код подверждение">
					</div>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						@click.prevent="edit"
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
			</div>
		</form>
	</div>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'Email',
		data() {
			return {
				table: 1,

				email: '',
				isEmail: false,
				email_valid_message: [],

				email_new: '',
				isEmailNew: false,
				email_new_valid_message: [],

				code: '',
				isCode: false,
				code_valid_message: [],

				code_new: '',
				isCodeNew: false,
				code_new_valid_message: [],

				isReadOnly: false,

				forms: {},

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			}
		},
		methods: {
			editEmail() {
				this.forms = {
					email: this.email,
					code: this.code,
					email_new: this.email_new,
					code_new: this.code_new
				}
				API.post('/api/admin/settings/editemail', {etap: this.table, forms: this.forms})
				.then( response => {
					if (response && response.data) {
						if (response.data.message) {
							if (this.table == 4 && response.data.access_token) {
								localStorage.setItem("access_token", response.data.access_token);
								this.email = ''
								this.code = ''
								this.email_new = ''
								this.code_new = ''
							}
							setTimeout(() => {
								this.table = this.table < 4 ? this.table + 1 : 1
							}, 1400);
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
			edit() {
				this.isReadOnly = true;
				this.loading = true;

				this.isEmail = false;
				this.email_valid_message = [];
				this.isCode = false;
				this.code_valid_message = [];
				this.isEmailNew = false;
				this.email_new_valid_message = [];
				this.isCodeNew = false;
				this.code_new_valid_message = [];

				switch (this.table) {
					case 1:
						if (this.email.length == 0) {
							this.isEmail = true;
							this.email_valid_message.push('Заполните обязательное поле!');
						} else if (this.validEmail(this.email)) {
							this.isEmail = true;
							this.email_valid_message.push('Неправильный E-mail!');
						}
						if (!this.isEmail) {
							this.editEmail()
						} else {
							this.finishResult('Ошибка валидации', true)
						}
						break;
					case 2:
						if (this.code.toString().length < 4) {
							this.isCode = true;
							this.code_valid_message.push('Не менее 4 символов!');
						} else if (this.code.toString().length > 4) {
							this.isCode = true;
							this.code_valid_message.push('Не более 4 символов!');
						}
						if (!this.isEmail && !this.isCode) {
							this.editEmail()
						} else {
							this.finishResult('Ошибка валидации', true)
						}
						break;
					case 3:
						if (this.email_new.length == 0) {
							this.isEmailNew = true;
							this.email_new_valid_message.push('Заполните обязательное поле!');
						} else if (this.validEmail(this.email_new)) {
							this.isEmailNew = true;
							this.email_new_valid_message.push('Неправильный E-mail!');
						}
						if (!this.isEmail && !this.isCode && !this.isEmailNew) {
							this.editEmail()
						} else {
							this.finishResult('Ошибка валидации', true)
						}
						break;
					case 4:
						if (this.code_new.toString().length < 4) {
							this.isCodeNew = true;
							this.code_code_valid_message.push('Не менее 4 символов!');
						} else if (this.code_new.toString().length > 4) {
							this.isCodeNew = true;
							this.code_code_valid_message.push('Не более 4 символов!');
						}
						if (!this.isEmail && !this.isCode && !this.isEmailNew && !this.isCodeNew) {
							this.editEmail()
						} else {
							this.finishResult('Ошибка валидации', true)
						}
						break;
				}
			},
			finishResult(message, errorStatus = false) {
				setTimeout(() => {
					this.resultMessage = message
					this.result = true
					this.loading = false;
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
					}, 1400);
				}, 600);
			},
			validEmail(email) {
				return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(email);
			},
		},
		computed: {
		},
		components: {
		}
    }
</script>