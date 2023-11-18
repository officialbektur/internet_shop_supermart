<template>
	<section class="user">
		<div class="user__body">
			<div class="user__header user-header">
				<button @click.prevent="$store.commit('setIsResetPassword', false)" type="button" class="user-header-button__back user-header-button-back a-hover-bgc">
					<span class="user-header-button-back__icon">
						<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke="none" d="M0 0h24v24H0z"/><path d="M14 8V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h7a2 2 0 002-2v-2"/><path d="M20 12H7l3-3m0 6l-3-3"/></svg>
					</span>
					<span class="user-header-button-back__title">
						Выйти
					</span>
				</button>
				<div class="user-header__title">
					Сброс пароля
				</div>
			</div>
			<div class="user__content">
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
						<div class="block-form__item">
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
								<span class="block-form-submit__title">Сбросить</span>
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
		name: 'ResetPassword',
		data() {
			return {
				email: '',
				isEmail: false,
				email_valid_message: [],

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
			reset() {
				API.post("/api/admin/users/resetpassword", {
					email: this.email.trim()
				})
				.then( response => {
					if (response && response.data && response.data.message) {
						this.finishResult(response.data.message);
						setTimeout(() => {
							this.$store.commit("setIsResetPassword", false)
						}, 1200);
					}
				})
				.catch( error => {
					if (error.response && error.response.data && error.response.data.error) {
						this.finishResult(error.response.data.error, true);
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
			},
			send() {
				this.isReadOnly = true;
				this.loading = true;

				this.isEmail = false;
				this.email_valid_message = [];

				if (this.email.length == 0) {
					this.isEmail = true;
					this.email_valid_message.push('Заполните обязательное поле!');
				} else if (this.validEmail()) {
					this.isEmail = true;
					this.email_valid_message.push('Неправильный E-mail!');
				}

				if (!this.isEmail) {
					this.reset()
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
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 1400);
				}, 600);
			},
			validEmail() {
				return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(this.email);
			},
		},
		computed: {
		},
		components: {
		}
	}
</script>

<style scoped>
</style>