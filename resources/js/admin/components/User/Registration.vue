<template>
	<section class="user">
		<div class="user__body">
			<div class="user__content">
				<div class="user__avatar">
					<svg viewBox="0 0 349.667 349.667" xmlns="http://www.w3.org/2000/svg"><path d="M174.833 197.204c24.125 0 80.846-29.034 80.846-98.603C255.68 44.145 248.329 0 174.833 0c-73.495 0-80.846 44.145-80.846 98.602 0 69.568 56.721 98.602 80.846 98.602zM106.07 82.146c5.679-10.983 17.963-23.675 44.381-23.112 0 0 15.746 38.194 93.05 21.042.312 6.101.41 12.326.41 18.526 0 34.005-15.015 55.075-27.612 66.762-15.872 14.727-33.494 20.072-41.466 20.072-7.972 0-25.594-5.345-41.466-20.072-12.597-11.687-27.612-32.757-27.612-66.762.001-5.501.081-11.021.315-16.456z"/><path d="M324.926 298.327c-4.127-25.665-12.625-58.724-29.668-70.472-11.638-8.024-52.243-29.718-69.582-38.982l-.3-.16a5.666 5.666 0 00-6.17.541c-9.083 7.131-19.033 11.937-29.573 14.284a5.669 5.669 0 00-4.067 3.521l-10.733 28.291-10.733-28.291a5.669 5.669 0 00-4.067-3.521c-10.54-2.347-20.49-7.153-29.573-14.284a5.664 5.664 0 00-6.17-.541c-17.133 9.155-58.235 31.291-69.831 39.107-19.619 13.217-28.198 61.052-29.718 70.507a5.674 5.674 0 00.253 2.792c.702 1.982 18.708 48.548 149.839 48.548s149.137-46.566 149.839-48.548a5.664 5.664 0 00.254-2.792zM264.5 282.666l-25.667 8-25.667-8v-13.81H264.5v13.81z"/></svg>
				</div>
				<form method="POST" class="user__form user-form block__form block-form">
					<div class="block-form__items">
						<div
							class="block-form__item"
							:class="{ '_error': isEmail }">
							<label for="email" class="block-form__label">
								Введите email*:
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
									:readonly="isReadOnly"
									autocomplete="email"
									class="block-form-input__input"
									placeholder="Введите email">
							</div>
						</div>
						<div
							class="block-form__item"
							:class="{ '_error': isPassword }">
							<label
								for="password"
								class="block-form__label">
								Введите пароль*:
								<template v-if="isPassword">
									<span v-for="message in password_valid_message">
										{{ message + ' ' }}
									</span>
								</template>
							</label>
							<div class="block-form-item__content block-form-input">
								<div class="block-form-input__icon">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
								</div>
								<input
									:type="show_password ? 'text' : 'password'"
									id="password"
									v-model="password"
									:readonly="isReadOnly"
									autocomplete="new-password"
									class="block-form-input__input"
									placeholder="Введите пароль">
								<button
									@click="showPassword"
									type="button"
									class="block-form-input__preview block-form-input-preview a-hover-bgc"
									:class="{'_show': show_password}">
									<span class="block-form-input-preview__show">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
									</span>
									<span class="block-form-input-preview__hide">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
									</span>
								</button>
							</div>
						</div>
						<div
							class="block-form__item"
							:class="{ '_error': isPassword }">
							<label
								for="password_confirmation"
								class="block-form__label">
								Введите повторно пароль*:
							</label>
							<div class="block-form-item__content block-form-input">
								<div class="block-form-input__icon">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
								</div>
								<input
									:type="show_password ? 'text' : 'password'"
									id="password_confirmation"
									v-model="password_confirmation"
									:readonly="isReadOnly"
									autocomplete="new-password"
									class="block-form-input__input"
									placeholder="Повторите пароль">
								<button
									@click="showPassword"
									type="button"
									class="block-form-input__preview block-form-input-preview a-hover-bgc"
									:class="{'_show': show_password}">
									<span class="block-form-input-preview__show">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
									</span>
									<span class="block-form-input-preview__hide">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
									</span>
								</button>
							</div>
						</div>
						<div
							class="block-form__item">
							<button
								type="submit"
								@click.prevent="send"
								:disabled="isReadOnly"
								class="block-form__button block-form__submit block-form-submit"
								:class="{
										'_loading': loading,
										'_sending': result,
										'_error': isErrorResult
									}">
								<span class="block-form-submit__title">Зарегистрироваться</span>
								<span class="block-form-submit__result">{{ resultMessage }}</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'Registration',
		data() {
			return {
				email: '',
				isEmail: false,
				email_valid_message: [],

				password: '',
				isPassword: false,
				password_valid_message: [],

				password_confirmation: '',

				show_password: false,

				isReadOnly: false,

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			}
		},
		mounted() {
		},
		methods: {
			registeration() {
				API.post("/api/admin/users/registration", {
					email: this.email.trim(),
					password: this.password.trim(),
					password_confirmation: this.password_confirmation.trim()
				})
				.then( response => {
					if (response && response.data && response.data.message && response.data.access_token) {
						localStorage.setItem("access_token", response.data.access_token)
						this.finishResult(response.data.message)
						setTimeout(() => {
							this.$store.commit("setIsVerify", true)
						}, 1200);
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
				.catch( error => {
					if (error.response && error.response.data && error.response.data.error) {
						this.finishResult(error.response.data.error, true);
					} else {
						this.finishResult('Непредвиденная ошибка1', true);
					}
				})
			},
			send() {
				this.isReadOnly = true
				this.loading = true;

				this.isEmail = false;
				this.email_valid_message = [];

				this.isPassword = false;
				this.password_valid_message = [];

				if (this.email.length == 0) {
					this.isEmail = true;
					this.email_valid_message.push('Заполните обязательное поле!');
				} else if (this.validEmail()) {
					this.isEmail = true;
					this.email_valid_message.push('Неправильный E-mail!');
				}

				if (this.password.length < 8) {
					this.isPassword = true;
					this.password_valid_message.push('Не менее 8 символов!');
				} else if (this.password.length > 120) {
					this.isPassword = true;
					this.password_valid_message.push('Менее 120 символов!');
				}

				if (this.validPassword()) {
					this.isPassword = true;
					this.password_valid_message.push('Пароли не сошлись!');
				}

				if (!this.isEmail && !this.isPassword) {
					this.registeration()
				} else {
					this.finishResult('Ошибка валидации', true)
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
						} else {
							this.email = '';
							this.password = '';
							this.password_confirmation = '';
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 1400);
				}, 600);
			},
			showPassword() {
				return this.show_password ? this.show_password = false : this.show_password = true
			},
			validEmail() {
				return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(this.email);
			},
			validPassword() {
				return this.password !== this.password_confirmation;
			}
		},
		computed: {
		},
		components: {
		}
	}
</script>

<style scoped>
</style>
