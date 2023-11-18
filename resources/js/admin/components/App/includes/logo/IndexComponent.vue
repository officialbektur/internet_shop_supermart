<template>
	<div class="block">
		<button
			type="button"
			@click.prevent="$parent.spollers($event)"
			class="block-form__spollers block-form-spollers">
			<div class="block-form-spollers__title">Логотип</div>
			<div class="block-form-spollers__button block-form-spollers-button">
				<span class="block-form-spollers-button__icon">
					<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
				</span>
			</div>
		</button>
		<div hidden class="block__body">
			<div class="block__content block__form block-form">
				<form method="post" class="mrb-admin__form mrb-admin-form" enctype="multipart/form-data">
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label
								for="logoInput"
								class="mrb-admin-form__label"
								:class="{ '_error': isLogo }">
								Выберите изображение*:
								<template
									v-if="isLogo">
									<span
										v-for="message in logo_valid_message"
										:key="message">
										{{ message + ' ' }}
									</span>
								</template>
							</label>
						</div>
						<div
							class="mrb-admin-form-media__block mrb-admin-form-media-block"
							:class="{ '_error': isLogo }">
							<div class="mrb-admin-form-media__content _active">
								<input
									id="logoInput"
									ref="inputLogo"
									@change="handleFileChange($event)"
									:disabled="isReadOnly"
									accept=".jpg, .png, .jpeg, .webp"
									type="file"
									name="logo"
									class="mrb-admin-form-media-block__input">
								<div class="mrb-admin-form-media-block__preview">
									<img src="/storage/project/logo/logo.png" alt="logo">
								</div>
								<button
									:disabled="isReadOnly"
									@click.prevent="resetImageInput($event)"
									type="button"
									class="mrb-admin-form-media-block__close">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
								</button>
								<div class="mrb-admin-form-media-block__hello mrb-admin-form-media-block-hello">
									<div class="mrb-admin-form-media-block-hello__icon">
										<svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M30 6l3.66 4H40c2.2 0 4 1.8 4 4v24c0 2.2-1.8 4-4 4H8c-2.2 0-4-1.8-4-4V14c0-2.2 1.8-4 4-4h6.34L18 6h12zm-6 13.6a6.4 6.4 0 100 12.8 6.4 6.4 0 000-12.8zM24 36c-5.52 0-10-4.48-10-10s4.48-10 10-10 10 4.48 10 10-4.48 10-10 10z"/></svg>
									</div>
									<div class="mrb-admin-form-media-block-hello__title">
										Добавьте фото
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__innerbutton">
						<button
							type="submit"
							@click.prevent="send"
							:disabled="isReadOnly"
							class="block-form__button block-form__submit block-form-submit"
							:class="{
								'_loading': loading,
								'_sending': result,
								'_error':  isErrorResult
							}">

							<span class="block-form-submit__title">Изменить</span>
							<span class="block-form-submit__result">{{ resultMessage }}</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'ExampleComponent',
		data() {
			return {
				isLogo: false,
				logo_valid_message: [],


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
			updateLogo() {
				const data = {
					logo: this.$refs[`inputLogo`].files[0],
				}
				API.post(`/api/admin/app/logo`, data, {
					headers: {
						"Content-Type": "multipart/form-data",
					}
				})
				.then( response => {
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
			send() {
				this.isReadOnly = true
				this.loading = true

				this.isLogo =  false
				this.logo_valid_message = []

				if (this.$refs[`inputLogo`].files.length === 0) {
					this.isLogo =  true
					this.logo_valid_message.push('Выберите логотип!')
				}
				if (!this.isLogo) {
					this.updateLogo()
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
			handleFileChange(event) {
				const selectedfiles = event.target.files;
				if (selectedfiles.length > 0) {
					this.uploadFile(event.target);
				}
			},
			uploadFile(file) {
				if (!file) {
					return false;
				}
				if (!["image/jpeg", "image/png", "image/webp"].includes(file.files[0].type)) {
					alert("Разрешены толко изображения.");
					file.value = "";
					return false;
				}
				// Проверим размер файла (< 2 mb)
				if (file.files[0].size > 2 * 1024 * 1024) {
					alert("Файл должен быть менее 2 mb, а ваш файл состовляет: " + Math.ceil(file.files[0].size / 1024 / 1024) + "mb");
					file.value = "";
					return false;
				}
				let reader = new FileReader();
				reader.onload = function (e) {
					file.parentElement.querySelector(".mrb-admin-form-media-block__preview").innerHTML = "";

					file.parentElement.querySelector(".mrb-admin-form-media-block__preview").innerHTML += `<img src="${e.target.result}" alt="img">`;

					file.parentElement.classList.add("_active");
				};
				reader.readAsDataURL(file.files[0]);
			},
			resetImageInput(event) {
				let element = event.target.parentElement;
				element.querySelector('.mrb-admin-form-media-block__input').value = null
				element.classList.remove("_active");
				element.querySelector('.mrb-admin-form-media-block__preview').innerHTML = '';
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