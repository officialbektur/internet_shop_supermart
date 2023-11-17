<template>
	<div class="block">
		<div class="block__title">Изменить пароль</div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					class="block-form__item"
					:class="{ '_error': isPasswordOld }">
					<label for="password" class="block-form__label">
						Введите пароль:
						<template v-if="isPasswordOld">
							<span v-for="message in password_old_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							:type="show_password_old ? 'text' : 'password'"
							id="password"
							v-model="password_old"
							:readonly="isReadOnly"
							autocomplete="off"
							class="block-form-input__input"
							placeholder="Введите пароль">
						<button
							@click="showPasswordOld"
							type="button"
							class="block-form-input__preview block-form-input-preview a-hover-bgc"
							:class="{'_show': show_password_old}">
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
					:class="{ '_error': isPasswordNew }">
					<label for="password_new" class="block-form__label">
						Новый пароль:
						<template v-if="isPasswordNew">
							<span v-for="message in password_new_valid_message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							:type="show_password_new ? 'text' : 'password'"
							id="password_new"
							v-model="password_new"
							:readonly="isReadOnly"
							autocomplete="new-password"
							class="block-form-input__input"
							placeholder="Новый пароль">
						<button
							@click="showPasswordNew"
							type="button"
							class="block-form-input__preview block-form-input-preview a-hover-bgc"
							:class="{'_show': show_password_new}">
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
					:class="{ '_error': isPasswordNew }">
					<label for="password_new_confirmation" class="block-form__label">
						Повторите новый пароль:
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M144 144v48h160v-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zm-64 48v-48C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64v192c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64h16z"/></svg>
						</div>
						<input
							:type="show_password_new ? 'text' : 'password'"
							v-model="password_new_confirmation"
							id="password_new_confirmation"
							:readonly="isReadOnly"
							autocomplete="new-password"
							class="block-form-input__input"
							placeholder="Повторите новый пароль">
						<button
							@click="showPasswordNew"
							type="button"
							class="block-form-input__preview block-form-input-preview a-hover-bgc"
							:class="{'_show': show_password_new}">
							<span class="block-form-input-preview__show">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
							</span>
							<span class="block-form-input-preview__hide">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
							</span>
						</button>
					</div>
				</div>
				<div class="block-form__item">
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
		name: 'Login',
		data() {
			return {
				id: null,

				password_old: '',
				isPasswordOld: false,
				password_old_valid_message: [],

				show_password_old: false,

				password_new: '',
				isPasswordNew: false,
				password_new_valid_message: [],

				password_new_confirmation: '',

				show_password_new: false,

				isReadOnly: false,

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			}
		},
		mounted() {
			this.userInfoId()
		},
		methods: {
			userInfoId(){
				API.post('/api/admin/auth/me')
				.then( response => {
					if (response && response.data) {
						if (response && response.data && response.data.id) {
							this.id = response.data.id
						}
					}
				})
			},
			editPassword() {
				if (!this.id) {
					this.finishResult('Непредвиденная ошибка, перезагрузите страницу!', true);
					return false;
				}
				API.post('/api/admin/settings/editpassword', {
					id: this.id,
					password_old: this.password_old,
					password_new: this.password_new,
					password_new_confirmation: this.password_new_confirmation
				})
				.then( response => {
					if (response && response.data) {
						if (response.data.message && response.data.access_token) {
							localStorage.setItem("access_token", response.data.access_token)
							this.finishResult(response.data.message)
							this.password_old = ''
							this.password_new = ''
							this.password_new_confirmation = ''
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
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
			},
			edit() {
				this.isReadOnly = true
				this.loading = true;

				this.isPasswordNew = false;
				this.password_new_valid_message = [];

				this.isPasswordOld = false;
				this.password_old_valid_message = [];

				if (this.password_new.length < 8) {
					this.isPasswordNew = true;
					this.password_new_valid_message.push('Не менее 8 символов!');
				} else if (this.password_new.length > 120) {
					this.isPasswordNew = true;
					this.password_new_valid_message.push('Менее 120 символов!');
				}

				if (this.password_old.length < 8) {
					this.isPasswordOld = true;
					this.password_old_valid_message.push('Не менее 8 символов!');
				} else if (this.password_old.length > 120) {
					this.isPasswordOld = true;
					this.password_old_valid_message.push('Менее 120 символов!');
				}


				if (this.validPassword()) {
					this.isPasswordOld = true;
					this.password_old_valid_message.push('Пароли не сошлись!');
				}

				if (!this.isPasswordNew && !this.isPasswordOld) {
					this.editPassword()
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
							this.password_old = '';
							this.password_new = '';
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 1200);
				}, 600);
			},
			showPasswordOld() {
				return this.show_password_old ? this.show_password_old = false : this.show_password_old = true
			},
			showPasswordNew() {
				return this.show_password_new ? this.show_password_new = false : this.show_password_new = true
			},
			validPassword() {
				return this.password_new !== this.password_new_confirmation;
			}
		},
		computed: {
		},
		components: {
		}
    }
</script>